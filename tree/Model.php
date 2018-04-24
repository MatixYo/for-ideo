<?php

class Model {
	protected $db;

	function __construct() {
		$this->db = new PDO('pgsql:dbname=ideo;host=127.0.0.1', '', '');
	}

	function get($desc = false) {
		$query = $this->db->query('SELECT path, text from tree order by text ' . ($desc ? 'desc' : 'asc'));
		$tree = [];
		foreach($query->fetchAll() as $row) {
			$keys = explode('.', $row['path']);
			
			$node = &$tree;
			
			foreach($keys as $key) {
				if(!(array_key_exists('children', $node) && array_key_exists($key, $node['children'])))
					$node['children'][$key] = [];
				$node = &$node['children'][$key];
    	    }

    	    $node['text'] = $row['text'];
    	    $node['path'] = $row['path'];
		}

		return $tree;
	}

	function add($path, $text) {
		if($path === 'root')
			$path = uniqid(8);
		elseif(!$this->exists($path))
			return;
		else
			$path .= '.' . uniqid(8);
		$query = $this->db->prepare('insert into tree (text, path) values (:text, :path)');
		$query->bindValue(':text', htmlspecialchars($text), PDO::PARAM_STR);
		$query->bindValue(':path', $path, PDO::PARAM_STR);
		$query->execute();
	}

	function edit($path, $text) {
		$query = $this->db->prepare('update tree set text = :text where path = :path)');
		$query->bindValue(':path', $path, PDO::PARAM_STR);
		$query->bindValue(':text', htmlspecialchars($text), PDO::PARAM_STR);
		$query->execute();
	}

	function move($source, $destination) {
		if($destination !== '' && !$this->exists($destination))
			return;
		$query = $this->db->prepare('update tree set path = :destination || subpath(path, nlevel(:source)-1) where path <@ :source');
		$query->bindValue(':source', $source, PDO::PARAM_STR);
		$query->bindValue(':destination', $destination, PDO::PARAM_STR);
		$query->execute();
	}

	function remove($path) {
		$query = $this->db->prepare('delete from tree where :path @> path;');
		$query->bindValue(':path', $path, PDO::PARAM_STR);
		$query->execute();
	}

	private function exists($path) {
		$query = $this->db->prepare('select 1 from tree where path = :path');
		$query->bindValue(':path', $path, PDO::PARAM_STR);
		$query->execute();
		return isset($query->fetch()['0']);
	}
}
