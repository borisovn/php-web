<?php
	include 'Book.php';

	$books = Book::GetDefaultBooks();

	foreach($books as $book) {
		echo  "Book: " . $book->getName() . "  Price: " . $book->getPrice() . "</br>";
	}