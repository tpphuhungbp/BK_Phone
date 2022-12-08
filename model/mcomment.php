<?php
$url = $_SERVER['REQUEST_URI'];
if (strlen(strstr($url, 'admin')) > 0) {
    include_once '../lib/database.php';
} else {
    include_once './lib/database.php';
}
?>


<?php class comment
{
    private $user_id;
    private $product_id;
    private $comment;
    private $score;

    public function __construct($user_id, $product_id, $comment, $score)
    {
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->comment = $comment;
        $this->score = $score;
    }
    public function insert_comment()
    {
        $db = new Database();

        $query = "INSERT INTO comment(user_id,product_id,comment,score) values('$this->user_id','$this->product_id','$this->comment','$this->score')";
        $ketqua = $db->insert($query);
        if ($ketqua == true) {
            $alert =
                "<script>alert('Cảm ơn bạn đã đẻ lại bình luận!')</script>";
            return $alert;
        } else {
            $alert = "<script>alert('Bình luận thất bại!')</script>";
            return $alert;
        }
    }
    public static function get_comment()
    {
        $db = new Database();
        $query = "select * from comment order by score desc";
        $ketqua = $db->select($query);
        return $ketqua;
    }
    public static function get_comment_byPid($product_id)
    {
        $db = new Database();
        $query = "select * from comment where product_id=$product_id order by score desc";
        $ketqua = $db->select($query);
        return $ketqua;
    }
    public static function update_comment($id, $comment, $score)
    {
        $db = new Database();

        $sql = "update contact set comment = $comment, score = $score where id = $id";
        $ketqua = $db->update($sql);
        return $ketqua;
    }
}

?>
