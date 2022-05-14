<?php

    function addComments(int $userid,int $blogid,string $comment_text){
        include "ayar.php";
        $query = "INSERT INTO comments(user_id, blog_id, comment_text) VALUES (?,?,?)";
        $result = mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($result, 'iis', $userid,$blogid,$comment_text);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);
    }

    function getCommentsByBlogId(int $blog_id){
        include "ayar.php";
        $query = "SELECT*FROM comments WHERE blog_id = $blog_id";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }
    function getCommentsById($id){
        include "ayar.php";
        $query = "SELECT * FROM comments WHERE comment_id = $id";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }
    function getComments(){
        include "ayar.php";
        $query = "SELECT * FROM  comments ORDER BY comment_id DESC";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }
    function deleteComment($id){
        include "ayar.php";
        $query = "DELETE FROM comments WHERE comment_id = $id LIMIT 1";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }
    function editComment($id,$isActive, $comment_text){
        include "ayar.php";
    
        $query = "UPDATE comments SET comment_isActive = ?, comment_text = ? WHERE comment_id = ?";

        $result = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($result, 'isi', $isActive,$comment_text,$id);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);

        return $result;
    }
    function getUsername(int $user_id){
        include "ayar.php";
        $query = "SELECT username FROM users WHERE id = $user_id";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }


    

     function getSlider() {
        include "ayar.php";
    
        $query = "SELECT * FROM slider_data ORDER BY dateAdded";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }
    function createSlider(string $slidername, $image, $isActive=0) {
        include "ayar.php";
     
        $query = "INSERT INTO slider_data(imageUrl, sliderName, isActive) VALUES (?,?,?)";
        $result = mysqli_prepare($connection,$query);
     
        mysqli_stmt_bind_param($result, 'ssi',  $image, $slidername, $isActive);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);
        mysqli_close($connection);
     
        return $result;
     }
     function getSliderById(int $id) {
        include "ayar.php";
    
        $query = "SELECT * FROM slider_data Where id = $id ";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }

    function deleteSlider(int $id) {
        include "ayar.php";
        $query = "DELETE FROM slider_data WHERE id=$id";
        $result = mysqli_query($connection,$query);
        return $result;
    }
    function editSlider(int $id, string $sliderName, string $imageUrl, int $isActive) {
        include "ayar.php";
    
        $query = "UPDATE slider_data SET sliderName=?,imageUrl=?,  isActive=? WHERE id=?";

        $result = mysqli_prepare($connection,$query);

        mysqli_stmt_bind_param($result, 'ssii', $sliderName,$imageUrl,$isActive,$id);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);

        return $result;
    }
function createBlog(string $title,int $imdb,string $sdescription, string $description, string $imageUrl,string $url, int $isActive=0) {
   include "ayar.php";

   $query = "INSERT INTO blogs(title,imdb_score, short_description, description, imageUrl, url, isActive) VALUES (?, ?, ?, ?, ?, ?, ?)";
   $result = mysqli_prepare($connection,$query);

   mysqli_stmt_bind_param($result, 'sissssi', $title,$imdb,$sdescription,$description,$imageUrl,$url,$isActive);
   mysqli_stmt_execute($result);
   mysqli_stmt_close($result);

   return $result;
}

function getBlogs() {
    include "ayar.php";

    $query = "SELECT * from blogs ORDER BY id DESC";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogsByFilters($categoryId, $keyword, $page) {
    include "ayar.php";

    $pageCount = 4;
    $offset = ($page-1) * $pageCount; 
    $query = "";

    if(!empty($categoryId)) {
        $query = "from blog_category bc inner join blogs b on bc.blog_id=b.id WHERE bc.category_id=$categoryId AND isActive=1";
    } else {
        $query = "from blogs b WHERE b.isActive=1";
    }
    $keyword = strtolower(control_input($keyword));

    if(!empty($keyword)) {
        $query .= " && b.title LIKE '%$keyword%' or b.description LIKE '%$keyword%'";
    }

    $total_sql = "SELECT COUNT(*) ".$query;

    $count_data = mysqli_query($connection, $total_sql);
    $count = mysqli_fetch_array($count_data)[0];
    $total_pages = ceil($count / $pageCount);

    $sql = "SELECT * ".$query." LIMIT $offset, $pageCount";
    $result = mysqli_query($connection, $sql);
    mysqli_close($connection);
    return array(
        "total_pages" => $total_pages,
        "data" => $result
    );
}

function getHomePageBlogs() {
    include "ayar.php";

    $query = "SELECT * from blogs WHERE isActive=1 and isHome=1 ORDER BY dateAdded DESC LIMIT 10";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}
function getLastBlogs() {
    include "ayar.php";

    $query = "SELECT * from blogs WHERE isActive=1 ORDER BY dateAdded DESC LIMIT 5";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}


function getBlogById(int $movieId) {
    include "ayar.php";

    $query = "SELECT * from blogs WHERE id='$movieId'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}
function getBlogCount()
{
    include "../libs/ayar.php";
    $query = "SELECT Count(*) as blogCount from blogs ";
    $result = mysqli_query($connection,$query);
    $data = mysqli_fetch_assoc($result);
    mysqli_close($connection);
    
    return $data["blogCount"];
}

function editBlog(int $id, string $title,int $imdb, string $description, string $sdescription,string $imageUrl,string $url, int $isActive, int $isHome) {
    include "ayar.php";

    $query = "UPDATE blogs SET title=?,imdb_score=?,short_description=?, description=?,imageUrl=?, url=?, isActive=?,isHome=? WHERE id=?";

    $result = mysqli_prepare($connection,$query);

    mysqli_stmt_bind_param($result, 'sissssiii', $title,$imdb,$sdescription,$description,$imageUrl,$url,$isActive,$isHome, $id);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);

    return $result;
}

function clearBlogCategories(int $blogid) {
    include "ayar.php";

    $query = "DELETE FROM blog_category WHERE blog_id = $blogid";
    $result = mysqli_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}

function addBlogToCategories(int $blogid, array $categories) {
    include "ayar.php";

    $query = "";

    foreach($categories as $catid) {
        $query .= "INSERT INTO blog_category(blog_id,category_id) VALUES ($blogid, $catid);";
    }

    $result = mysqli_multi_query($connection,$query);
    echo mysqli_error($connection);

    return $result;
}

function deleteBlog(int $id) {
    include "ayar.php";
    $query = "DELETE FROM blogs WHERE id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}

function getCategories() {
    include "ayar.php";

    $query = "SELECT * from categories";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getCategoriesByBlogId($id) {
    include "ayar.php";

    $query = "SELECT c.id,c.name from blog_category bc inner join categories c on bc.category_id=c.id WHERE bc.blog_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogsByCategoryId($id) {
    include "ayar.php";

    $query = "SELECT * from blog_category bc inner join blogs b on bc.blog_id=b.id WHERE bc.category_id=$id";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}

function getBlogsByKeyword($q) {
    include "ayar.php";

    $query = "SELECT * FROM blogs WHERE title LIKE '%$q%' or description LIKE '%$q%'";
    $result = mysqli_query($connection, $query);
    mysqli_close($connection);
    return $result;
}


function createCategory(string $categoryname,$isActive=0) {
    include "ayar.php";
 
    $query = "INSERT INTO categories(name, isActive) VALUES (?,?)";
    $result = mysqli_prepare($connection,$query);
 
    mysqli_stmt_bind_param($result, 'si', $categoryname, $isActive);
    mysqli_stmt_execute($result);
    mysqli_stmt_close($result);
    mysqli_close($connection);
 
    return $result;
 }

 function getCategoryById(int $categoryId) {
    include "ayar.php";

    $query = "SELECT * from categories WHERE id='$categoryId'";
    $result = mysqli_query($connection,$query);
    mysqli_close($connection);
    return $result;
}

function editCategory(int $id, string $categoryname, int $isActive) {
    
    include "ayar.php";

    $query = "UPDATE categories SET name=?, isActive=? WHERE id=?   ";

        $result = mysqli_prepare($connection,$query);
        mysqli_stmt_bind_param($result, 'sii', $categoryname,$isActive,$id);
        mysqli_stmt_execute($result);
        mysqli_stmt_close($result);

        return $result;
}

function deleteCategory(int $id) {
    include "ayar.php";
    $query = "DELETE FROM categories WHERE id=$id";
    $result = mysqli_query($connection,$query);
    return $result;
}


function control_input($data) {
    include "ayar.php";

    $data = trim($data);
    $data = stripslashes($data); # sql injection
    $data = mysqli_real_escape_string($connection,$data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data);
    // $title = htmlentities($data);
    mysqli_close($connection);
    return $data;
}

function kisaAciklama($aciklama, $limit) {
    if (strlen($aciklama) > $limit) {
        echo mb_substr($aciklama,0,$limit)."...";
    } else {
        echo $aciklama;
    };
}

function isLoggedin() {
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    } else {
        return false;
    }
}

function isAdmin() {
    if (isLoggedin() && isset($_SESSION["user_type"]) && $_SESSION["user_type"] === "admin") {
        return true;
    } else {
        return false;
    }
}

function saveImage($file) {
    $message = ""; 
    $uploadOk = 1;
    $fileTempPath = $file["tmp_name"];
    $fileName = $file["name"];
    $fileSize = $file["size"];
    $maxfileSize = ((1024 * 1024) * 10);
    $dosyaUzantilari = array("jpg","jpeg","png");
    $uploadFolder = "./img/";

    if($fileSize > $maxfileSize) {
        $message = "Dosya boyutu fazla.<br>";
        $uploadOk = 0;
    }

    $dosyaAdi_Arr = explode(".", $fileName);
    $dosyaAdi_uzantisiz = $dosyaAdi_Arr[0];
    $dosyaUzantisi = $dosyaAdi_Arr[1];

    if(!in_array($dosyaUzantisi, $dosyaUzantilari)) {
        $message .= "dosya uzantısı kabul edilmiyor.<br>";
        $message .= "kabul edilen dosya uzantıları : ".implode(", ", $dosyaUzantilari)."<br>";
        $uploadOk = 0;
    }

    $yeniDosyaAdi = md5(time().$dosyaAdi_uzantisiz).'.'.$dosyaUzantisi;
    $dest_path = $uploadFolder.$yeniDosyaAdi;

    if($uploadOk == 0) {
        $message .= "Dosya yüklenemedi.<br>";
    } else {
        if(move_uploaded_file($fileTempPath, $dest_path)) {
            $message .="dosya yüklendi.<br>";
        }
    }

    return array(
        "isSuccess" => $uploadOk,
        "message" => $message,
        "image" => $yeniDosyaAdi
    );
}
?>