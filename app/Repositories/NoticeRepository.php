<?php
namespace App\Repositories;
use App\Notice;
class NoticeRepository
{
    public function generateNotice( $data )
    {
        Notice::create( $data );
    }
    public function getNoticeBoard()
    {
        return Notice::orderby('created_at','Desc')->paginate(10);
    }
}
