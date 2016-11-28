<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | This file is where you may define all of the routes that are handled
  | by your application. Just tell Laravel the URIs it should respond
  | to using a Closure or controller method. Build something great!
  |
 */

Route::get('/', function () {
    return view('welcome');
});
Route::get('universities/add', 'UniversityController@insertUniversities');
Route::get('courses/add', 'UniversityController@insertCourses');
Route::any('universities/list', 'UniversityController@getList');
Route::any('courses/coursesList', 'UniversityController@getCoursesList');
Route::get('/user/activate', 'UserController@activate');
Route::get('/user/activate/post', 'UserController@activatePost');
Route::get('user/forgotPassword', 'UserController@forgotPassword');
Route::post('user/forgotPasswordSendEmail', 'UserController@forgotPasswordSendEmail');
Route::get('user/needHelp', 'UserController@needHelp');
Route::get('user/termsOfServices', 'UserController@termsOfServices');
Route::get('user/terminate', 'UserController@terminate');







Auth::routes();
Route::group(['middleware' => ['auth', 'isUserActive']], function () {



    /**
     * Admin Start
     */
    Route::get('admin/university/basicInfo', 'UniversityController@basicInfo');
    Route::post('admin/university/basicInfo', 'UniversityController@basicInfoForm');
    Route::post('admin/universityInfoStore', 'UniversityController@universityInfoStore');
    Route::get('admin/university/newsForm', 'UniversityController@newsForm');
    Route::post('admin/university/newsForm', 'UniversityController@getNewsForm');
    Route::post('admin/universityNewsStore', 'UniversityController@universityNewsStore');

    /*
     * 
     * End-Admin
     */





    Route::post('user/updateHeader', 'NotificationController@updateHeader');

    Route::post('user/getUniversityNews', 'UniversityController@getUniversityNews');

    Route::post('user/getStudentOrFacultyPaginator', 'UniversityController@getStudentOrFacultyPaginator');

    Route::get('user/university/page/{id}', 'UniversityController@getUniversityPage');
    Route::post('user/getLibrariesForHomePage', 'HomeController@getLibrariesForHomePage');

    Route::get('admin/feedback', 'FeedbackController@viewFeedback');
    Route::get('admin/management', 'UserController@userManageMent');
    Route::any('admin/getUserManagement', 'DatatablesController@getUserManagement');
    Route::any('user/updateUserStatus', 'UserController@updateUserStatus');
    
    
    Route::any('user_profile/experience/delete', 'UserController@deleteExperience');
    
    
    
    

    Route::any('user/getFolowers', 'UserController@getFolowers');
    Route::get('/home', 'HomeController@index');
    Route::post('question/comment/store', 'QuestionController@storeComment');
    Route::post('question/like/store', 'QuestionController@storeLike');

    Route::get('question/get/{id}', 'QuestionController@getQuestion');
    Route::get('question/get/{x}/{y}', 'QuestionController@getQuestionWithNotification');

    Route::get('questions/index', 'QuestionController@index');
    Route::post('questions/create', 'QuestionController@store');
    Route::get('questions/create', 'QuestionController@create');
    Route::post('question/delete', 'QuestionController@delete');
    Route::post('question/comment/delete', 'QuestionController@deleteComment');
    Route::post('question/comment/edit', 'QuestionController@editComment');
    Route::get('question/edit/{id}', 'QuestionController@edit');
    Route::post('question/edit', 'QuestionController@editStore');



    Route::post('library/delete', 'LibraryController@delete');
    Route::post('library/comment/delete', 'LibraryController@deleteComment');
    Route::post('library/comment/edit', 'LibraryController@commentStore');
    Route::get('library/edit/{id}', 'LibraryController@editLibraryForm');
    Route::post('library/edit', 'LibraryController@editLibraryStore');



    Route::get('libraries/create', 'LibraryController@create');
    Route::get('libraries/index', 'LibraryController@index');
    Route::post('libraries/create', 'LibraryController@store');

    Route::get('library/get/{id}', 'LibraryController@getLibrary');
    Route::get('library/get/{x}/{y}', 'LibraryController@getLibraryWithNotification');

    Route::post('library/comment/store', 'LibraryController@storeComment');
    Route::get('user_profile', 'UserController@profile');
    Route::post('user_profile/summary', 'UserController@profileSummary');
    Route::post('user_profile/experience', 'UserController@profileExperience');
    Route::post('user_profile/skill', 'UserController@profileSkill');
    Route::post('user_profile/skill/delete', 'UserController@profileSkillDelete');

    Route::post('user/university/store', 'UserController@profileUniversity');
    Route::post('user_profile/education/delete', 'UserController@profileEducationDelete');
    Route::post('user_profile/picture', 'UserController@profilePicture');
    Route::get('user_profile/helpcenter', 'UserController@helpCenter');
    Route::get('user/setting', 'UserController@setting');
    Route::post('user/setting', 'UserController@settingStore');

    Route::get('user/profile/{id}', 'UserController@openProfile');
    Route::get('user/profile/{x}/{y}', 'UserController@openProfileWithNotification');

    Route::get('user/chat/{id}', 'ChatController@openChatBox');
    Route::post('user/chat/send', 'ChatController@sendMessage');
    Route::post('user/feedback', 'FeedbackController@feedback');
    Route::get('user/feedback/form', 'FeedbackController@feedbackForm');
    Route::get('user/notice/board', 'NoticeController@noticeBoard');
    Route::post('admin/notice/create', 'NoticeController@generateNotice');
    Route::get('admin/notice/form', 'NoticeController@showNoticeForm');
    Route::post('notice/delete', 'NoticeController@delete');

    Route::any('/search', 'DatatablesController@search');
    Route::any('/search/user', 'DatatablesController@anyData');
    Route::any('/search/question', 'DatatablesController@searchQuestion');
    Route::any('/search/library', 'DatatablesController@searchLibrary');
    Route::any('/search/type', 'DatatablesController@getPageOnType');

    Route::any('admin/getFeedbacks', 'DatatablesController@getFeedbacks');


    View::composer('layouts.master', function ($view) {
        $data = ( new \App\Http\Gateways\ChatGateway())->getLastMessageOfEachConversation();
        $notificationData = ( new App\Http\Gateways\NotificationGateway())->getNotificationForHeader();
        return $view->with([
                    "messages" => $data,
                    'notifications' => $notificationData['notifications'],
                    'unReadNotificationsCount' => $notificationData['unReadNotificationCount'],
        ]);
    });
    Route::get('user/messages', 'ChatController@getMessages');
    Route::post('user/messages/sent', 'ChatController@getSentMessages');
    Route::post('user/messages/delete', 'ChatController@delete');
    Route::post('user/follow', 'UserController@follow');
    Route::post('user/accetpOrRejectFollow', 'UserController@accetpOrRejectFollow');
    Route::get('user/getFollowers', 'UserController@getFollowers');
    Route::get('user/getFollowings', 'UserController@getFollowings');
    Route::get('user/followings/pendingRequests', 'UserController@pendingRequests');



    Route::get('user/helpcenter/Welcome', 'UserController@helpCenterWelcome');
    Route::get('user/helpcenter/AccountManagement', 'UserController@helpCenterAccountManagement');
    Route::get('user/helpcenter/ContactUs', 'UserController@helpCenterContactUs');
    Route::get('user/helpcenter/CookiePolicy', 'UserController@helpCenterCookiePolicy');
    Route::get('user/helpcenter/EventManagement', 'UserController@helpCenterEventManagement');
    Route::get('user/helpcenter/Faq', 'UserController@helpCenterFaq');
    Route::get('user/helpcenter/KnowledgeCenter', 'UserController@helpCenterKnowledgeCenter');
    Route::get('user/helpcenter/MessagingChatting', 'UserController@helpCenterMessagingChatting');
    Route::get('user/helpcenter/Privacy', 'UserController@helpCenterPrivacy');
    Route::get('user/helpcenter/TermsConditions', 'UserController@helpCenterTermsConditions');

    Route::get('user/notifications', 'NotificationController@getNotifications');

    Route::get('events/{x}/{y}', 'EventsController@getEventWithNotification');
    Route::get('event/booking/{id}', 'EventsController@bookEvent');
    Route::get('user/event/bookings', 'EventsController@myBookedEvent');



    Route::resource('events', 'EventsController');
    Route::get('get_calendar', 'EventsController@getEvent');
    Route::post('modify_entry', 'EventsController@modify_entry');
    Route::get('calendar_delete', 'EventsController@calendar_delete');
});

