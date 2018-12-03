# ArkX

> :warning: Before running this on mainnet make sure you have properly tested it with your configuration on devnet. :warning:

Source of [https://arkx.io/](https://arkx.io/).

## Requirements

- A license for https://nova.laravel.com for the administration.
- [Remote PostgreSQL Connection](./README_PSQL.md)

## Development

- https://laravel.com/docs/5.7/homestead
- https://laravel.com/docs/5.7/valet
- https://vessel.shippingdocker.com/

## Deployment

> It is recommended to manage deployment via https://forge.laravel.com/ and https://envoyer.io/.

### Migration

```
php artisan migrate:fresh
php artisan db:seed --class=ProductionSeeder
```

### Configure Ark

> Open the `.env` file and adjust the following values.

```
ARK_DB_HOST=
ARK_DB_PORT=
ARK_DB_DATABASE=
ARK_DB_USERNAME=
ARK_DB_PASSWORD=

ARK_RELAY=

ARK_DELEGATE_USERNAME=
ARK_DELEGATE_ADDRESS=
ARK_DELEGATE_PUBLIC_KEY=

ARK_SHARE_PERCENTAGE=
ARK_SHARE_THRESHOLD=
ARK_SHARE_VENDOR_FIELD=

ARK_TRUSTEE_PASSPHRASE=
ARK_TRUSTEE_SECOND_PASSPHRASE=
```

> `ARK_TRUSTEE_PASSPHRASE` and `ARK_TRUSTEE_SECOND_PASSPHRASE` will need to be encrypted with `encrypt` via `php artisan tinker`.

### Configure Services

> Open the `.env` file and adjust the following values.

```
APP_HEARTBEAT=http://beats.envoyer.io/heartbeat/...

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=
AWS_BUCKET=
AWS_URL=

SPARKPOST_SECRET=

AUTHY_SECRET=

SENTRY_LARAVEL_DSN=
```

> Those values are required to enable backups, mail transport, two-factor authentication and error tracking.

### Poll

```
php artisan ark:poll:delegate
php artisan ark:poll:voters
```

After that is done you should set up the [Scheduler](https://laravel.com/docs/5.7/scheduling#introduction) so your data can be updated on a regular basis and disbursements be send out.

## Security

If you discover a security vulnerability within this package, please send an e-mail to hello@brianfaust.me. All security vulnerabilities will be promptly addressed.

## Credits

- [Brian Faust](https://github.com/faustbrian)
- [All Contributors](../../contributors)

## License

[MIT](LICENSE) © [ArkX](https://arkx.io)
