<table class="table table-hover table-striped">
    <div class="box-header with-border">
        <h3 class="box-title">Sent</h3>
        <!-- /.box-tools -->
    </div>
    <tbody>
        @foreach($sent as $message)
        <tr>
            <td>
                <div class="btn-group">
                    <button onClick="deleteChat({{$message['id']}})" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                </div>
            </td>
            <td class="mailbox-name"><a href="/user/chat/{{$message['receiver_id']}}">{{$message['receiver_name']}}</a></td>
            <td class="mailbox-subject">{{$message['message']}}
            </td>
            <td class="mailbox-attachment"></td>
            <td class="mailbox-date">{{$message['created_at']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>