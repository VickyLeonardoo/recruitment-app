# To learn more about how to use Nix to configure your environment
# see: https://developers.google.com/idx/guides/customize-idx-env
{pkgs}: {
  # Which nixpkgs channel to use.
  channel = "stable-23.11"; # or "unstable"
  # Use https://search.nixos.org/packages to find packages
  packages = [
    (pkgs.php82.buildEnv {
       extensions = ({enabled, all}: enabled ++ (with all; [
         # redis
       ]));
    })
    pkgs.php82Packages.composer
    pkgs.nodejs_20
    # pkgs.sqlite
  ];

  # Enable to install MySQL/MariaDB
  services.mysql = {
    enable = true;
    package = pkgs.mariadb;
  };

  # Enable to install PostgreSQL
  # services.postgres = {
  #   enable = true;
  #   package = pkgs.postgresql
  # };

  # Enable to install Redis
  # services.redis = {
  #   enable = true;
  #   port = 6379
  # };

  # Enable to install Docker
  # services.docker.enable = true;

  # Sets environment variables in the workspace
  env = {};
  idx = {
    # Search for the extensions you want on https://open-vsx.org/ and use "publisher.id"
    extensions = [
      "formulahendry.auto-close-tag"
      "formulahendry.auto-complete-tag"
      "formulahendry.auto-rename-tag"
      "mikestead.dotenv"
      "abusaidm.html-snippets"
      "xabikos.JavaScriptSnippets"
      "amirmarmul.laravel-blade-vscode"
      "amirmarmul.laravel-blade-vscode"
      "shufo.vscode-blade-formatter"
      "onecentlin.laravel-blade"
      "amiralizadeh9480.laravel-extra-intellisense"
      "MrChetan.laravel-goto-config"
      "codingyu.laravel-goto-view"
      "porifa.laravel-intelephense"
      "mohamedbenhida.laravel-intellisense"
      "onecentlin.laravel5-snippets"
      "stef-k.laravel-goto-controller"
      "PKief.material-icon-theme"
      "zhuangtongfa.material-theme"
      "felixfbecker.php-debug"
      "bmewburn.vscode-intelephense-client"
      "MehediDracula.php-namespace-resolver"
      "wongjn.php-sniffer"

    ];
    # Enable previews and customize configuration
    previews = {
      enable = true;
      previews = {
        web = {
          command = ["php" "artisan" "serve" "--port" "$PORT" "--host" "0.0.0.0"];
          manager = "web";
        };
      };
    };
  };
}
