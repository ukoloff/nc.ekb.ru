<?php
// $Id: decorator.inc.php,v 1.6 2006/08/03 19:03:33 xzilla Exp $

// This group of functions and classes provides support for
// resolving values in a lazy manner (ie, as and when required)
// using the Decorator pattern.

###TODO: Better documentation!!!

// Compatibility functions:
if (!function_exists('is_a')) {
	function is_a($object, $class) {
		return is_object($object) && get_class($object) == strtolower($class) || is_subclass_of($object, $class);
	}
}

// Construction functions:

function field($fieldName, $default = null) {
	return new FieldDecorator($fieldName, $default);
}

function merge(/* ... */) {
	return new ArrayMergeDecorator(func_get_args());
}

function concat(/* ... */) {
	return new ConcatDecorator(func_get_args());
}

function callback($callback, $params = null) {
	return new CallbackDecorator($callback, $params);
}

function ifempty($value, $empty, $full = null) {
	return new IfEmptyDecorator($value, $empty, $full);
}

function url($base, $vars = null /* ... */) {
	// If more than one array of vars is given,
	// use an ArrayMergeDecorator to have them merged
	// at value evaluation time.
	if (func_num_args() > 2) {
		$v = func_get_args();
		array_shift($v);
		return new UrlDecorator($base, new ArrayMergeDecorator($v));
	}
	return new UrlDecorator($base, $vars);
}

function noEscape($value) {
	if (is_a($value, 'Decorator')) {
		$value->esc = false;
		return $value;
	}
	return new Decorator($value, false);
}

function prepareSQL($sql, $params) {
	return new PrepareSQL($sql, $params);
}

// Resolving functions:

function value(&$var, &$fields, $esc = null) {
	if (is_a($var, 'Decorator')) {
		$val = $var->value($fields);
		if (!$var->esc) $esc = null;
	} else {
		$val =& $var;
	}
	if (is_string($val)) {
		switch($esc) {
			case 'xml':
				return strtr($val, array(
					'&' => '&amp;',
					"'" => '&apos;', '"' => '&quot;',
					'<' => '&lt;', '>' => '&gt;'
				));
			case 'html':
				return htmlspecialchars($val);
			case 'url':
				return urlencode($val);
		}
	}
	return $val;
}

function value_xml(&$var, &$fields) {
	return value($var, $fields, 'xml');
}

function value_xml_attr($attr, &$var, &$fields) {
	$val = value($var, $fields, 'xml');
	if (!empty($val))
		return " {$attr}=\"{$val}\"";
	else
		return '';
}

function value_url(&$var, &$fields) {
	return value($var, $fields, 'url');
}

// Underlying classes:

class Decorator
{
	var $esc = true;
	
	function Decorator($value, $esc = true) {
		$this->v = $value;
		$this->esc = $esc;
	}
	
	function value() {
		return $this->v;
	}
}

class FieldDecorator extends Decorator
{
	function FieldDecorator($fieldName, $default = null) {
		$this->f = $fieldName;
		if ($default !== null) $this->d = $default;
	}
	
	function value($fields) {
		return isset($fields[$this->f]) ? $fields[$this->f] : (isset($this->d) ? $this->d : null);
	}
}

class ArrayMergeDecorator extends Decorator
{
	function ArrayMergeDecorator($arrays) {
		$this->m = $arrays;
	}
	
	function value($fields) {
		$accum = array();
		foreach($this->m as $var) {
			$accum = array_merge($accum, value($var, $fields));
		}
		return $accum;
	}
}

class ConcatDecorator extends Decorator
{
	function ConcatDecorator($values) {
		$this->c = $values;
	}
	
	function value($fields) {
		$accum = '';
		foreach($this->c as $var) {
			$accum .= value($var, $fields);
		}
		return trim($accum);
	}
}

class CallbackDecorator extends Decorator
{
	function CallbackDecorator($callback, $param = null) {
		$this->fn = $callback;
		$this->p = $param;
	}
	
	function value($fields) {
		return call_user_func($this->fn, $fields, $this->p);
	}
}

class IfEmptyDecorator extends Decorator
{
	function IfEmptyDecorator($value, $empty, $full = null) {
		$this->v = $value;
		$this->e = $empty;
		if ($full !== null) $this->f = $full;
	}
	
	function value($fields) {
		$val = value($this->v, $fields);
		if (empty($val))
			return value($this->e, $fields);
		else
			return isset($this->f) ? value($this->f, $fields) : $val;
	}
}

class UrlDecorator extends Decorator
{
	function UrlDecorator($base, $queryVars = null) {
		$this->b = $base;
		if ($queryVars !== null)
			$this->q = $queryVars;
	}
	
	function value($fields) {
		$url = value($this->b, $fields);
		
		if ($url === false) return '';
		
		if (!empty($this->q)) {
			$queryVars = value($this->q, $fields);
			
			$sep = '?';
			foreach ($queryVars as $var => $value) {
				$url .= $sep . value_url($var, $fields) . '=' . value_url($value, $fields);
				$sep = '&';
			}
		}
		return $url;
	}
}

class PrepareSQL extends Decorator
{
	function PrepareSQL($sql, $params) {
		$this->q = $sql;
		$this->p = $params;
	}

	function value($fields) {
		$req = $this->q;
		foreach ($this->p as $k => $v) {
			$req = str_replace($k, value($v, $fields), $req);
		}
		return $req;
	}
}
?>
