<?php

class View {
	protected $tree;

	function __construct($tree) {
		$this->tree = $tree;
	}

	static private function editableLeafElement($tree) {
		return isset($_POST['editable']) && $_POST['editable'] === $tree['path']
			? '<input name="edit" value="' . $tree['text'] . '"><button name="path" value="' . $tree['path'] . '">Zapisz</button>'
			: $tree['text'] . '<button name="editable" value="' . $tree['path'] . '">Edytuj</button>';
	}

	static private function addLeafElement($tree, $root) {
		return isset($_POST['addable']) && ($root && $_POST['addable'] === 'root' || isset($tree['path']) && $_POST['addable'] === $tree['path'])
			? '<input name="add" placeholder="Wpisz tekst"><button name="path" value="' . ($root ? 'root' : $tree['path']) . '">Dodaj</button>'
			: '<button name="addable" value="' . ($root ? 'root' : $tree['path']) . '">Dodaj liść</button>';
	}

	static function renderBlock($tree, $root = false) {
		$html = $root
			? '<ul class="tree">'
			: '<input type="checkbox" checked id="' . $tree['path'] . '"><label class="tree-label" for="' . $tree['path'] . '">' . self::editableleafElement($tree) . '<button name="remove" value="' . $tree['path'] . '">Usuń</button></label><ul>';
		if(isset($tree['children'])) {
			foreach($tree['children'] as $leaf) {
				$html .= '<li data-path="' . $leaf['path'] . '" draggable="true">';
				$html .= self::renderBlock($leaf);
				$html .= '</li>';
			}
		}
		$html .= '<li><span class="tree-label">' . self::addLeafElement($tree, $root) . '</span></li></ul>';
		return $html;
	}

	function get() {
		return self::renderBlock($this->tree, true);
	}
}
