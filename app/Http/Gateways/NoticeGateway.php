<?php
namespace App\Http\Gateways;
use App\Repositories\QuestionRepository;
use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
class NoticeGateway
{
    public function generateNotice( $request )
    {
        $user = \Auth::user();
        $filters = ['title','description'];
        $filteredData = CommonFunction::filterDataFromRequest( $request->all(), $filters);
        $filteredData['user_id'] = $user->id;
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                  $fileData = CommonFunction::uploadFile( $request->file('file'), $user,900,300);
                  $filteredData['path']      = $fileData['path'];
                  $filteredData['filename']  = $fileData['filename'];
             }
        }
        ( new \App\Repositories\NoticeRepository())->generateNotice( $filteredData );
        return redirect('/home'); 
    }
    
    public function getNoticeBoard()
    {
        $user = (new \App\Http\Gateways\UserGateway())->getUser( \Auth::id() );
        $notifications = (new \App\Repositories\NoticeRepository())->getNoticeBoard();
        foreach ( $notifications as &$notification )
        {
            if( !empty($notification->path) && !empty($notification->filename) ) {
                if( CommonFunction::isImage($notification->filename) ){
                  $notification['attachment'] = '<img class="img-responsive pad" src="'.$notification->path.'" alt="Photo">'; 
                }
                if( CommonFunction::isAudtio($notification->filename) ){
                   $notification['attachment'] = '<audio controls>
                <source src="'.$notification->path.'" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
                }
                if( CommonFunction::isFile($notification->filename) ){
                      $notification['attachment'] = '<a  target="_blank" class="img-responsive pad" href="'.$notification->path.'">'.$notification->filename.'</a>'; 
                }
            }
        }
        return view('pages.user.noticeBoard')->with([
            'user' => $user,
            'notifications' => $notifications,
        ]);
    }
}
