# Guide de migration vers Symfony 5

## Changements apportés

### Dépendances
- **PHP minimum** : 7.2.5 (requis par Symfony 4.4+)
- **Symfony** : Compatible avec 4.4 et 5.x
- **PHPUnit** : Mis à jour vers 8.x/9.x

### Changements techniques

#### 1. composer.json
- Mise à jour de `symfony/property-access` vers `^4.4 || ^5.0`
- PHP minimum requis : `>=7.4`
- PHPUnit mis à jour vers `^8.0 || ^9.0`

#### 2. Tests
- Remplacement de `\PHPUnit_Framework_TestCase` par `PHPUnit\Framework\TestCase`
- Ajout des imports `use PHPUnit\Framework\TestCase;`

## Instructions de migration

### 1. Mettre à jour les dépendances

```bash
cd /var/www/Yoopies/GraphQL
composer update
```

### 2. Lancer les tests

```bash
vendor/bin/phpunit
```

## Compatibilité

- ✅ Symfony 4.4
- ✅ Symfony 5.0+
- ✅ PHP 7.2.5+
- ✅ PHP 8.0+

## Notes

Les versions antérieures à Symfony 4.4 ne sont plus supportées.
