<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;
use application\models\User;

require_once 'const.php';

class AdminController extends Controller
{

    protected $userModel;
    protected $adminModel;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->userModel = new User();
        $this->adminModel = new Admin();
    }

    public function indexAction()
    {
        if (!empty($_SESSION)) {
            header('Location: /admin/dashboard/');
        }
        $this->view->render('index');
    }

    public function loginAction()
    {
        if ((!empty($_POST['login'])) && (!empty($_POST['password']))) {
            $login = trim($_POST['login']);
            $pass = trim($_POST['password']);
            $passHash = md5($pass);
            $res = $this->userModel->getUsers($login);
            if ($res[0]['pass'] === $passHash) {
                $_SESSION['user'] = $login;

                return $this->view->redirect('dashboard');
            } else {
                return $this->view->redirect('index');
            }
        }

        return $this->view->redirect('index');
    }

    public function logoutAction()
    {
        unset($_SESSION['user']);

        return $this->view->redirect('/');
    }

    public function dashboardAction()
    {
        if (empty($_SESSION)) {
            return $this->view->redirect('index');
        }
       return $this->view->render('Dashboard');
    }

    public function createAction()
    {
        $this->view->render('Dashboard');
    }

    public function uploadImage($image)
    {
        if (isset($_FILES['image'])) {
            $image = $_FILES['image']['name'];
            $fileTmpName = $_FILES['image']['tmp_name'];
            $fi = finfo_open(FILEINFO_MIME_TYPE);
            $mime = (string)finfo_file($fi, $fileTmpName);
            if (strpos($mime, 'image') === false) {
                die('NE KARTINKA');
            }
            $name = $image; //name image
            $tmp_name = $_FILES['image']['tmp_name']; // get tmp name
            move_uploaded_file($tmp_name, UPLOAD_IMG.$name);
            $new_path = UPLOAD_IMG.$name;

            return $new_path;
        }
        return false;
    }

    public function saveAction()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $image = $this->uploadImage($_FILES['image']);
        $link = $_POST['link'];
        $status = $_POST['status'];
        $pos = $_POST['position'];

        $this->adminModel->bannerAdd($id, $title, $image, $link, $status, $pos);

        return $this->view->redirect('dashboard');
    }

    public function updateAction()
    {
        $bool = $this->adminModel->bannerUpd();
        if ($bool === null) {
            return $this->view->redirect('dashboard');
        }
    }

    public function deleteAction()
    {
        $id = $_POST['del'];
        $this->adminModel->bannerDelete($id);

        return $this->view->redirect('dashboard');
    }

    public function editAction()
    {
        $this->adminModel->getItembyId();
        $this->view->render('Editing');
    }
}