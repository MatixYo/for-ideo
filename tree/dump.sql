--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


--
-- Name: ltree; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS ltree WITH SCHEMA public;


--
-- Name: EXTENSION ltree; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION ltree IS 'data type for hierarchical tree-like structures';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tree; Type: TABLE; Schema: public; Owner: matix; Tablespace: 
--

CREATE TABLE tree (
    path ltree NOT NULL,
    text text NOT NULL
);


ALTER TABLE tree OWNER TO matix;

--
-- Data for Name: tree; Type: TABLE DATA; Schema: public; Owner: matix
--

COPY tree (path, text) FROM stdin;
85adf33c20cc36	foo
85adf33c770f03	bar
85adf33c20cc36.85adf33ca985ae	fizz
85adf33c20cc36.85adf33ca985ae.85adf33d5a582d	Hello World
85adf33c20cc36.85adf33ca985ae.85adf33cee6646	bizz
\.


--
-- Name: public; Type: ACL; Schema: -; Owner: matix
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM matix;
GRANT ALL ON SCHEMA public TO matix;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

