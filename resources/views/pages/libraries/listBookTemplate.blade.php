@foreach( $libraries as $library ) 
@if($library['isValidToDisplay'] == 1)
<li class="item" id="libray-{{$library->id}}">
    <div class="product-img">
        <img src="{{$library->cover}}" alt="Product Image">
    </div>
    <div class="product-info">
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimize">
                <i class="fa fa-minus"></i>
            </button>
            @if( $user->id == $library->user_id )
            <button onClick="editLibrary('{{ \encrypt(  $library->id ) }}')" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit"></i>
            </button>
            <button onClick="deleteLibrary('{{\encrypt( $library->id )}}');" type="button" class="btn btn-box-tool"  data-toggle="tooltip" title="Delete">
                <i class="fa fa-times"></i>
            </button>
            @endif
        </div>
        <label> Author: &emsp;    
            <a href="/user/profile/{{$library->user_id}}" class="product-title"> {{$library->author}}</a>
        </label>
        <br>
        <label> Title: &emsp;    
            <span  class="product-title"> {{$library->title}}</span>
        </label>
        <span class="product-description">
            <?php echo strip_tags($library->description); ?>
        </span>
        <span class="product-description">
            @if(!empty($library['tags']))
                @foreach($library['tags'] as $tag )
                    <span class="label label-success"> {{ $tag->filter }}</span>
                @endforeach
            @endif
        </span>
        <br>
        <?php echo $library['attachment']; ?>
        <br>

        @include('pages.libraries.libraryComments')
    </div>
</li>

@endif
@endforeach
{{ $libraries->links() }}

