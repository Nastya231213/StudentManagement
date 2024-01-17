<?php 



class Pager {

    public $links=array();
    public $offset=0;
    public function __construct($limit=10){
        $page_number=isset($_GET['page'])?(int)$_GET['page']:1;
        $page_number=$page_number<1?1:$page_number;
        $this->offset=($page_number-1)*$limit;
        $current_link=ROOT."/".str_replace(["url=","index.php&"],"",$_SERVER['QUERY_STRING']);
        $next_link=preg_replace('/page=[0-9]+/',"page=".($page_number+1),$current_link);
        if($page_number==1){
            $prev_link=preg_replace('/page=[0-9]+/',"page=1",$current_link);

        }else{
            $prev_link=preg_replace('/page=[0-9]+/',"page=".($page_number-1),$current_link);

        }
        $this->links['prev']=$prev_link;

        $this->links['current']=$current_link;
        $this->links['next']=$next_link;

    }

    public function display(){

        ?>
        <div >
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
            </div>
            <?php
    }
}