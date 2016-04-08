<?php

	class Book {


		// private variables
		private $name;
		private $price;


		// constructor
		function  __construct($n,$p) {
			$this->name = $n;
			$this->price = $p;
		}


		public  function getName() {
			return $this->name;
		}

		public  function getPrice() {
			return $this->price;
		}


		public static function GetDefaultBooks() {
			return array(new Book("book01", 50),new Book("book02", 50),new Book("book03", 50),new Book("book04", 50),new Book("book05", 50));
	}

	}