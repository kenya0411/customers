
@include('common.components.alert')

<div class="settingUserFrom formSection ">   






{{-- 管理者 --}}
@can('admin')

<div class="list_mail_block send_common_block">
    <div class="heading_block">
        稼働中のアカウント
    </div>
<div class="wrap">
 <form action="/setting/users/ajax_update" method="post" >
    @csrf
<ul>
    <li class="headBlock">
        <div>修正</div>
        <div>名前</div>
        <div>ニックネーム</div>
        <div>パスワード</div>
        <div>権限</div>
        <div>削除</div>

    </li>


    <li v-for="user in users">
    	<div>
            <input type="checkbox" name="users_id[]" v-bind:value="user.id" >
    	</div>
        <div class="tab_heading">
           
            <input type="text" v-bind:name="`users_name[${user.id}]`" v-bind:value="user.name" >
        </div>
        <div>
            <input type="text" v-bind:name="`users_nickname[${user.id}]`"  v-bind:value="user.nickname" >
        	
        </div>
              <div>
            <input type="text"  v-bind:name="`users_password[${user.id}]`" >
        	
        </div>
        <div>
            <select  v-bind:name="`permissions_id[${user.id}]`" id="" v-bind:value="user.permissions_id">
            	<option v-bind:value="permission.id" v-for="permission in permissions">@{{permission.name}}</option>
            </select>
        </div>

        <div>
          <div class="delete_wrap">
        <button name="delete" v-bind:value="user.id" v-on:click="delete_confirm" >
            削除
        </button>
    </div>       
        </div>

    </li>
</ul>
     <div class="send_wrap">
        <button name="submit" value="update">
            メールアドレスを修正
        </button>
    </div>    

</form>

</div>
</div>


@endcan




</div>