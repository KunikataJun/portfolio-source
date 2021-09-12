<?php
const ROOT = '..';
require_once ROOT . "/private/init.php";
require_once User;

// ログイン済みならホームページへリダイレクト
if (User::is_logged_in()) {
    header('Location: ' . HOME_PAGE);
    exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Portfolio</title>
  <?php include HTML_HEAD_INC; ?>
  <style>
  .v-text-field {
    margin-top: 0;
    padding-top: 0;
  }

  .input-label {
    margin-left: 33px;
  }
  </style>
</head>
<body>
  <div id="app" class="wait-display">
    <v-app>
      <v-card width="400px" class="mx-auto mt-5">
        <v-card-title class="header-bg">
          <div class="h3"><?php echo APP_TITLE; ?></div>
        </v-card-title>
        <v-card-text>
          <v-form>
            <span class="input-label">ユーザ名</span>
            <v-text-field
              v-model="user"
              prepend-icon="mdi-account-circle">
            </v-text-field>
            <span class="input-label">パスワード</span>
            <v-text-field
              v-model="password"
              v-bind:type="showPassword ? 'text' : 'password'"
              prepend-icon="mdi-lock"
              v-bind:append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
              @click:append="showPassword = !showPassword"
              @keyup.enter="submit">
            </v-text-field>
            <v-card-actions class="justify-center">
              <v-btn
                color="#BDBDBD"
                class="white--text"
                @click="submit"
              >ログイン</v-btn>
            </v-card-actions>
          </v-form>
          <v-card-text
            class="text-center red--text"
            v-bind:class="{'d-none': hideAlert}"
          >ユーザ名またはパスワードが間違っています。</v-card-text>
        </v-card-text>
      </v-card>
    </v-app>
  </div>

  <?php include JS_LIBRARIES_INC; ?>
  <?php php_constants_to_js_variables(); ?>

  <script>
  new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data: {
      showPassword : false,
      user:'',
      password:'',
      hideAlert : true,
    },
    mounted: function() {
      var app = document.getElementById('app');
      app.classList.remove('wait-display');
    },
    methods: {
      submit: function() {
        var that = this;
        axios.post(AUTH_API, {
          action: 'login',
          user_id: this.user,
          password: this.password
        })
        .then(function (response) {
          //console.log(response); // **** debug ****
          if (response.data == 'success') {
            location.href = HOME_PAGE;
          } else {
            that.hideAlert = false;
          }
        })
      },
    },
  });
  </script>
</body>
</html>