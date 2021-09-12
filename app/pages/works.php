<?php
const ROOT = '..';
require_once ROOT . "/private/init.php";
require_once Auth;
require_once Util;
Auth::page_login_check();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>Portfolio/WORKS</title>
  <?php include HTML_HEAD_INC; ?>
  <style>
  .work-title {
    text-align: center;
  }
  </style>
</head>
<body>
  <div id="app" class="wait-display">
    <v-app>
      <v-app-bar app class="header-bg">
        <v-toolbar-title><?php echo APP_TITLE; ?></v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn text href="<?php echo PROFILE_PAGE; ?>">PROFILE</v-btn>
        <v-btn depressed disabled class="ml-2" href="<?php echo WORKS_PAGE; ?>">WORKS</v-btn>
        <v-btn text class="ml-2 mr-16" href="<?php echo CERTIFICATES_PAGE; ?>">CERTIFICATES</v-btn>
        <v-spacer class="ml-14"></v-spacer>
        <v-btn icon class="ml-16">
          <v-icon @click="logout">mdi-logout</v-icon>
        </v-btn>
      </v-app-bar>


      <v-main>
        <v-container>
          <v-row>
            <?php include DATA_DIR . '/' . 'card1-text.php'; ?>
            <?php include DATA_DIR . '/' . 'card2-text.php'; ?>
            <?php include DATA_DIR . '/' . 'card3-text.php'; ?>
          </v-row>

          <v-row>
            <?php include DATA_DIR . '/' . 'card4-text.php'; ?>
            <?php include DATA_DIR . '/' . 'card5-text.php'; ?>
            <!-- place holder
            <v-col>
              <v-card width="250px" height="250px" class="ma-auto d-none"></v-card>
            </v-col>
            -->
          </v-row>
        </v-container>
      </v-main>

      <?php include DATA_DIR . '/' . 'dialog1-text.php'; ?>
      <?php include DATA_DIR . '/' . 'dialog2-text.php'; ?>
      <?php include DATA_DIR . '/' . 'dialog3-text.php'; ?>
      <?php include DATA_DIR . '/' . 'dialog4-text.php'; ?>
      <?php include DATA_DIR . '/' . 'dialog5-text.php'; ?>


    </v-app>
  </div>

  <?php include JS_LIBRARIES_INC; ?>
  <?php php_constants_to_js_variables(); ?>

  <script>
  new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    data: {
      ready: false
    },
    mounted: function() {
      var app = document.getElementById('app');
      app.classList.remove('wait-display');
    },
    methods: {
      logout: function() { logout(); }
    }
  });
  </script>
</body>
</html>