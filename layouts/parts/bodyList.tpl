
<ul>
{foreach $list as $_key => $_value}
<div class='list'>
<li>
<span class="name">名前：{$_value.name}</span><br>
<span class="name">ジャンル：{$_value.genre}</span><br>
<span class="name">気になるメニュー：{$_value.menu}</span><br>
<span class="name">{$_value.time}</span><br>
<span class="name">{$_value.goWith}</span><br>
<span class="name">{$_value.note}</span><br>

<button class='revisit' value='{$_value.tbl_info_id}'>また行きたい！</button>
<button class='delete' value='{$_value.tbl_info_id}'>削除</button>
</li>
</div>
{/foreach}
</ul>
