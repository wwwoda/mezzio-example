# Mezzio Example

[mezzio-example](https://github.com/wwwoda/mezzio-example) is a starting point for PHP development projects.
It is build upon [mezzio](https://github.com/mezzio/mezzio) configured to work with following components:

* [laminas-router](https://github.com/laminas/laminas-router)
* [laminas-service-manager](https://github.com/laminas/laminas-service-manager) (configured to auto-wire dependencies)
* [laminas-view](https://github.com/laminas/laminas-view)
* [laminas-form](https://github.com/laminas/laminas-form)

It will offer following features:

- [x] Backend
- [x] Admin
- [x] User registration
- [x] User login
- [ ] User reset password
- [ ] User authorization
- [ ] User permissions
- [ ] User plans
- [x] Synchronous message bus  
- [ ] Asynchronous message bus
- [ ] Message queue & worker system
- [x] Asset management for application modules
- [ ] I18n
- [ ] Installer

## Getting Started

```bash
composer install
vendor/bin/doctrine-migrations migrations:migrate -n
```

This should get you started with a sqlite database (in `data/database.sqlite`) migrated to the latest version.

## Troubleshooting

## Application Tools

### To enable development mode

**Note:** Do NOT run development mode on your production server!

```bash
composer development-enable
```

**Note:** Enabling development mode will also clear your configuration cache, to 
allow safely updating dependencies and ensuring any new configuration is picked 
up by your application.

### To disable development mode

```bash
composer development-disable
```

### Development mode status

```bash
composer development-status
```

### Doctrine cli

```bash
vendor/bin/doctrine
```

### Doctrine migrations

```bash
vendor/bin/doctrine-migrations
```

### Generate di-aot-configuration

```bash
php bin/generate-di-cache.php
```

## Configuration caching

## Mezzio Example Development
