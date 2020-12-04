<?php

class Entry
{
    private $id;
    private $date;
    private $author;
    private $title;
    private $excerpt;
    private $dbh;

    public function __construct()
    {
        $this->dbh = new PDO("mysql:dbname=antblog;host=localhost;", 'root', 'root');
    }
    public function createNew($author, $title, $excerpt, $content)
    {
        $this->setByParams( -1, date("d.m.Y h:m"), $author, $title, $excerpt, $content);
    }
    public function createNewFromPOST($post)
    {
        $this->createNew(
            $post['enter_author'],
            $post['entry_excerpt'],
            $post['entry_title'],
            $post['entry_content']
        );
    }
    public function setByParams($id, $data, $author, $title, $excerpt, $content)
    {
        $this->$id = $id;
        $this->$author = $author;
        $this->$data = $data;
        $this->$title = $title;
        $this->$excerpt = $excerpt;
        $this->$content = $content;
    }
    public function setByRow($row)
    {
        $this->setByParams(
            $row['entry_id'],
            $row['entry_data'],
            $row['entry_author'],
            $row['entry_excerpt'],
            $row['entry_title'],
            $row['entry_content']
        );
    }

    public function SqlInsertEntry()
    {
        $query = "
            INSERT INTO entries (
                entry_author, entry_date, entry_excerpt, entry_title,
                entry_content)
            VALUES (
                :entry_author, :entry_date, :entry_excerpt, :entry_title,
                :entry_content);";

        $stmt = $this->dbh->prepare($query);
        $result = $stmt->execute(array(
            ':entry_author' => $this->author,
            ':entry_date' => $this->date,
            ':entry_excerpt' => $this->excerpt,
            ':entry_title' => $this->title,
            ':entry_content' => $this->content
            ));

        $query = '  SELECT entry_id
                    FROM entries
                    WHERE entry_author = :entry_author
                    ORDER BY id 
                    DESC LIMIT 1';
        $stmt = $this->dbh->prepare($query);
        $result = $stmt->execute(array(
            ':entry_author' => $this->author
            ));

        $this->id = $stmt->fetch(PDO::FETCH_ASSOC)['entry_id'];

        return $result;
                    
    }

    public function SqlSelectEntryById($entry_id)
    {
        $query = 'SELECT * FROM entries WHERE id = :entry_id;';

        $stmt = $this->dbh->prepare($query);
        $result = $stmt->execute(array(
            ':entry_id' => $this->id
            ));

        $entry = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->setByRow($entry);

        return $result;
    }
    public function SqlUpdateEntryById($entry_id)
    {
        $query = '  UPDATE entries SET
                    entry_author = :entry_author,
                    entry_title = :entry_title,
                    entry_content = :entry_content,
                    entry_excerpt = :entry_excerpt
                    WHERE entry_id = :entry_id;';
    $stmt = $this->dbh->prepare($query);
    $result = $stmt->execute(array(
        ':entry_author' => $this->author,
        ':entry_date' => $this->date,
        ':entry_excerpt' => $this->excerpt,
        ':entry_title' => $this->title,
        ':entry_content' => $this->content
            ));

    return $result;
    }
    private function validateString() {

    }
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get the value of author
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of excerpt
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * Set the value of excerpt
     *
     * @return  self
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;

        return $this;
    }
}
