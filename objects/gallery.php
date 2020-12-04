<?php

class Portfolio {
    private $conn;

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function allPortfolioItems() {

        $query = 'SELECT * FROM tbl_gallery';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function portfolioItem($id) {

        $query = 'SELECT * FROM tbl_gallery WHERE id = ' .$id;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

}
