<?php

namespace application\models;

use application\core\Model;
use http\Params;
use PDO;

class Admin extends Model
{

    public function getBanners()
    {
        return $this->db->row('SELECT * FROM banners order by pos ASC ');
    }

    public function bannerAdd($id, $title, $image, $link, $status, $position)
    {
        $params = [
            'id' => $id,
            'title' => $title,
            'image' => $image,
            'link' => $link,
            'status' => $status,
            'pos' => $position,
        ];
        $this->db->query('INSERT INTO banners VALUES (:id,:title, :image,:link,:status,:pos)', $params);
    }

    public function bannerUpd()
    {
        $params = [
            'id' => $_POST['id'],
            'title' => $_POST['name'],
            'link' => $_POST['link'],
            'status' => $_POST['status'],
            'pos' => $_POST['position'],
        ];
        $this->db->query(
            'UPDATE banners SET name = :title,link = :link,status = :status,pos =:pos WHERE id = :id',
            $params
        );
    }

    public function bannerDelete($id)
    {
        $params = [
            'id' => $id,
        ];
        $this->db->query('DELETE FROM banners WHERE id = :id', $params);
    }

    public function getItembyId()
    {
        $id = $_POST[''];
        $params = [
            'id' => $id,
        ];
        return $this->db->row('SELECT * FROM banners WHERE id = :id', $params);
    }

    public function uploadImage($image)
    {
        if (isset($_FILES['image'])) {
            $image = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string)finfo_file($fi, $fileTmpName);
            if (strpos($mime, 'image') === false) {
                die('Only Image');
            }
            $name = $image; //name image
            $tmp_name = $_FILES['image']['tmp_name']; // get tmp name
            move_uploaded_file($tmp_name, ROOT . UPLOAD_IMG . $name);
            $new_path = ROOT . UPLOAD_IMG . $name;

            return $new_path;
        }
        return false;
    }
}