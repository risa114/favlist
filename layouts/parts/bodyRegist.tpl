<form method='post' action='/index/regist/'>
<ul>
  <li>
    <h3>ジャンル</h3>
<input type="radio" name='genre' value='飲食店'>飲食店
<input type="radio" name='genre' value='居酒屋'>居酒屋
<input type="radio" name='genre' value='カフェ'>カフェ
<input type="radio" name='genre' value='スイーツ'>スイーツ
  </li>
  <li>
    <h3>お店の名前</h3>
<input type="text" name='name' value=''>
  </li>
  <li>
    <h3>場所</h3>
    <select id='prefectureList'>
      <option value=''>都道府県</option>
{foreach $prefecture key='key' item='value'}
      <option value={$value.mst_prefecture_id}>{$value.prefecture_name}</option>
{/foreach}
    </select>
    <select>
      <option value=''>市区町村</option>
    </select>
    <select>
      <option value=''>町名</option>
    </select>
<input type="text" name='block' placeholder="町名以下を入力" value=''>
  </li>
  <li>
    <h3>気になるメニュー</h3>
<input type="text" name='menu' value=''>
  </li>
  <li>
    <h3>行きたい時間帯</h3>
  <input type="checkbox" name='time[]' value='朝'>朝
  <input type="checkbox" name='time[]' value='昼'>昼
  <input type="checkbox" name='time[]' value='夜'>夜
  </li>
  <li>
    <h3>一緒に行きたい人</h3>
<input type="checkbox" name='goWith[]' value='一人で'>一人で
<input type="checkbox" name='goWith[]' value='会社'>会社
<input type="checkbox" name='goWith[]' value='友達'>友達
<input type="checkbox" name='goWith[]' value='家族'>家族
<input type="checkbox" name='goWith[]' value='異性'>異性
  </li>
  <li>
    <h3>メモ</h3>
<textarea name="note"></textarea>
  </li>
<input type='submit' value='登録'>
</ul>
</form>
