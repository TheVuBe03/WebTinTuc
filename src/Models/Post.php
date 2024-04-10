<?php

namespace Pc\Mvcoop\Models;

use Pc\Mvcoop\Commons\Model;

class Post extends Model
{

    public function getTop6()
    {
        try {
            $sql = "SELECT 
            p.id p_id ,
            c.name c_name,
            p.title p_title,
            p.excerpt p_excerpt,
            p.image p_image
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC LIMIT 6";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
    
    public function getFistLatest()
    {
        try {
            $sql = "SELECT 
            p.id p_id ,
            c.name c_name,
            p.title p_title,
            p.excerpt p_excerpt,
            p.image p_image
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            ORDER BY p.id DESC LIMIT 1";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
    public function getAll()
    {
        try {
            $sql = "SELECT 
                    p.id p_id ,
                    c.name c_name,
                    p.title p_title,
                    p.excerpt p_excerpt,
                    p.image p_image
                    FROM posts p
                    INNER JOIN categories c ON p.category_id = c.id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT 
            p.id p_id ,
            c.name c_name,
            p.title p_title,
            p.excerpt p_excerpt,
            p.image p_image,
            p.content p_content
            FROM posts p
            INNER JOIN categories c ON p.category_id = c.id
            WHERE p.id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
    public function insert($category_id, $title, $excerpt, $content, $image = null)
    {
        try {
            $sql = "
            INSERT INTO posts(category_id, title, excerpt, content, image) 
            VALUES (:category_id, :title, :excerpt, :content, :image)
            ";
            // echo $sql;
            // die();
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':excerpt', $excerpt);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image', $image);


            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function update($id, $category_id, $title, $content, $excerpt = null, $image = null)
    {
        try {
            $sql = "
                UPDATE posts 
                SET category_id     = :category_id, 
                    title           = :title, 
                    excerpt         = :excerpt, 
                    content         = :content, 
                    image           = :image
                WHERE id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':category_id', $category_id);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':excerpt', $excerpt);
            $stmt->bindParam(':content', $content);
            $stmt->bindParam(':image', $image);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }

    public function deleteById($id)
    {
        try {
            $sql = "DELETE FROM posts WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();
        } catch (\Exception $e) {
            echo 'ERROR: ' . $e->getMessage();
            die;
        }
    }
}
