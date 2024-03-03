<span align="left">

## Quick start

Several quick start options are available:

-   Clone the repo: `git clone https://github.com/rezaandreannn/bridging-ss.git`
-   Run `cd` to the newly created `/bridging-ss` directory
-   Run `composer install` command
-   Run `npm install` command
-   Run `npm run dev` command
-   Run `cp .env.example .env` command
-   Run `php artisan key:generate` command
-   Run `php artisan migrate` command
-   Run `php artisan serve` command
-   Done

<button class="btn" id="copy-command">Copy</button>

Read the [documentation page](https://getstisla.com/docs) for more information on the framework contents, templates and examples, and more.

## License

**Stisla** is licensed under the [MIT License](LICENSE)

<script>
document.getElementById('copy-command').addEventListener('click', function() {
  var commands = [
    'git clone https://github.com/rezaandreannn/bridging-ss.git',
    'cd /bridging-ss',
    'composer install',
    'npm install',
    'npm run dev',
    'cp .env.example .env',
    'php artisan key:generate',
    'php artisan migrate',
    'php artisan serve'
  ];
  navigator.clipboard.writeText(commands.join('\n')).then(function() {
    alert('Commands copied to clipboard');
  }, function(err) {
    console.error('Failed to copy commands: ', err);
  });
});
</script>
