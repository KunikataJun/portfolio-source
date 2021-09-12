<?php

// ----- ユーザ管理 ----- //

const ROOT = '../..';
require_once ROOT . "/private/init.php";
require_once Auth;
require_once DB;
require_once Util;

Auth::page_login_check();

$msg = "";

if (isset($_POST['create_user'])) {
  if (DB::create_new_user($_POST['id'], $_POST['role'], $_POST['password'])) {
    $msg = "新規ユーザ {$_POST['id']} を登録しました。";
  } else {
    $msg = "新規ユーザ {$_POST['id']} の登録に失敗しました。";
  }
}

if (isset($_POST['delete_user'])) {
  if (DB::delete_user($_POST['id'])) {
    $msg = "ユーザ {$_POST['id']} を削除しました。";
  } else {
    $msg = "ユーザ {$_POST['id']} の削除に失敗しました。";
  }
}

$data = DB::select("SELECT * from users");
?>

<table>
  <thead>
    <th>ID</th>
    <th>role</th>
    <th>password hash</th>
  </thead>
  <tbody>
<?php
foreach ($data as $row) {
  echo "<tr>";

  foreach ($row as $val) {
    echo "<td>$val</td>";
  }

  echo <<< END
<td>
  <form action="{$_SERVER['PHP_SELF']}" method="post">
    <input type="hidden" name="delete_user" value="1">
    <input type="hidden" name="id" value="{$row['id']}">
    <button>削除</button>
  </form>
</td>
END;

  echo "</tr>";
}
?>
  </tbody>
</table>

<?php echo $msg; ?>

<hr>

<div>新規ユーザ追加</div>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
  <input type="hidden" name="create_user" value="1">
  <div>
    <span>ID: <input type="text" name="id" required></span>
    <select name="role">
      <option value="guest">guest</option>
      <option value="admin">admin</option>
    </select>
    <span>password: <input type="password" name="password" required></span>
    <button>submit</button>
  </div>
</form>

