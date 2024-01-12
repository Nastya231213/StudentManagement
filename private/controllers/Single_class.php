<?php

class Single_class extends Controller{
    function index($id=''){
        $user=new User();
        $classes=new Classes_model();

        $row=$classes->whereOne('class_id',$id);
        
        $crumbs[]=['Dashboard','/'];
        $crumbs[]=['Classes','classes'];
        if($row){
            $crumbs[]=[$row->class,''];
            $row_user=$user->whereOne('url_address',$row->url_address);
        }
        $page_tab=isset($_GET['tab'])? $_GET['tab']:'lecturers';

        $this->view('single_class',['row'=>$row,'row_user'=>$row_user,'crumbs'=>$crumbs,'page_tab'=>$page_tab]);

    }
}