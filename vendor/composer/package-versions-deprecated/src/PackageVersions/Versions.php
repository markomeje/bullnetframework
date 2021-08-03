<?php

declare(strict_types=1);

namespace PackageVersions;

use Composer\InstalledVersions;
use OutOfBoundsException;

class_exists(InstalledVersions::class);

/**
 * This class is generated by composer/package-versions-deprecated, specifically by
 * @see \PackageVersions\Installer
 *
 * This file is overwritten at every run of `composer install` or `composer update`.
 *
 * @deprecated in favor of the Composer\InstalledVersions class provided by Composer 2. Require composer-runtime-api:^2 to ensure it is present.
 */
final class Versions
{
    /**
     * @deprecated please use {@see self::rootPackageName()} instead.
     *             This constant will be removed in version 2.0.0.
     */
    const ROOT_PACKAGE_NAME = '__root__';

    /**
     * Array of all available composer packages.
     * Dont read this array from your calling code, but use the \PackageVersions\Versions::getVersion() method instead.
     *
     * @var array<string, string>
     * @internal
     */
    const VERSIONS          = array (
  'brick/math' => '0.9.2@dff976c2f3487d42c1db75a3b180e2b9f0e72ce0',
  'cakephp/core' => '4.2.8@bed4b6f09550909beea5440627d5a6ff85fb1934',
  'cakephp/database' => '4.2.8@ef7f8ca5e782d54483267a0617118cac09768e57',
  'cakephp/datasource' => '4.2.8@cc101051e8d601cf6c2895d635ccefecca97ff4e',
  'cakephp/utility' => '4.2.8@4259ae4154e639557af751ae719d58253a79282a',
  'composer/package-versions-deprecated' => '1.11.99.2@c6522afe5540d5fc46675043d3ed5a45a740b27c',
  'doctrine/cache' => '2.1.1@331b4d5dbaeab3827976273e9356b3b453c300ce',
  'doctrine/dbal' => '2.13.2@8dd39d2ead4409ce652fd4f02621060f009ea5e4',
  'doctrine/deprecations' => 'v0.5.3@9504165960a1f83cc1480e2be1dd0a0478561314',
  'doctrine/event-manager' => '1.1.1@41370af6a30faa9dc0368c4a6814d596e81aba7f',
  'doctrine/lexer' => '1.2.1@e864bbf5904cb8f5bb334f99209b48018522f042',
  'doctrine/migrations' => '2.3.1@af915024d41669600354efe78664ee86dfca62e1',
  'egulias/email-validator' => '3.1.1@c81f18a3efb941d8c4d2e025f6183b5c6d697307',
  'fakerphp/faker' => 'v1.15.0@89c6201c74db25fa759ff16e78a4d8f32547770e',
  'fig/http-message-util' => '1.1.5@9d94dc0154230ac39e5bf89398b324a86f63f765',
  'graham-campbell/result-type' => 'v1.0.1@7e279d2cd5d7fbb156ce46daada972355cea27bb',
  'ipfinder/ipfinder' => 'v1.0.2@dc3ee7becdd102c139b84dbe7a3a173b6011a836',
  'jawira/plantuml' => 'v1.59.0@87dfd0ef5651f0591fb5909b9b29fd9d14bab8d5',
  'jean85/pretty-package-versions' => '2.0.4@694492c653c518456af2805f04eec445b997ed1f',
  'league/commonmark' => '1.6.6@c4228d11e30d7493c6836d20872f9582d8ba6dcf',
  'league/flysystem' => '1.1.4@f3ad69181b8afed2c9edf7be5a2918144ff4ea32',
  'league/mime-type-detection' => '1.7.0@3b9dff8aaf7323590c1d2e443db701eb1f9aa0d3',
  'league/pipeline' => '1.0.0@aa14b0e3133121f8be39e9a3b6ddd011fc5bb9a8',
  'league/tactician' => 'v1.1.0@e79f763170f3d5922ec29e85cffca0bac5cd8975',
  'league/tactician-bundle' => 'v1.3.0@89c51277423ac485b62580c38322426c3ec6ad47',
  'league/tactician-container' => '2.0.0@d1a5d884e072b8cafbff802d07766076eb2ffcb0',
  'league/tactician-logger' => 'v0.10.0@3ff9ee04e4cbec100af827f829ed4c7ff7c08442',
  'league/uri' => '6.4.0@09da64118eaf4c5d52f9923a1e6a5be1da52fd9a',
  'league/uri-interfaces' => '2.3.0@00e7e2943f76d8cb50c7dfdc2f6dee356e15e383',
  'monolog/monolog' => '2.3.2@71312564759a7db5b789296369c1a264efc43aad',
  'nikic/fast-route' => 'v1.3.0@181d480e08d9476e61381e04a71b34dc0432e812',
  'nikic/php-parser' => 'v4.12.0@6608f01670c3cc5079e18c1dab1104e002579143',
  'ocramius/proxy-manager' => '2.2.3@4d154742e31c35137d5374c998e8f86b54db2e2f',
  'opis/closure' => '3.6.2@06e2ebd25f2869e54a306dda991f7db58066f7f6',
  'php-di/invoker' => '2.3.2@5214cbe5aad066022cd845dbf313f0e47aed928f',
  'php-di/php-di' => '6.3.4@f53bcba06ab31b18e911b77c039377f4ccd1f7a5',
  'php-di/phpdoc-reader' => '2.2.1@66daff34cbd2627740ffec9469ffbac9f8c8185c',
  'php-di/slim-bridge' => '3.1.1@ad74ba03a3b97c717d58ac04b88671bafe4549c7',
  'phpdocumentor/flyfinder' => '1.1.0@6e145e676d9fbade7527fd8d4c99ab36b687b958',
  'phpdocumentor/graphviz' => '2.0.0@929e97b4ab6765fc4eb2f944b091a4a02807ee5d',
  'phpdocumentor/phpdocumentor' => 'v3.1.0@7015b11cf0733aaa94a059328bb8d948991630e1',
  'phpdocumentor/reflection' => '5.0.0@1b70ad9839e288f98f8d162f88754598f207fcae',
  'phpdocumentor/reflection-common' => '2.2.0@1d01c49d4ed62f25aa84a747ad35d5a16924662b',
  'phpdocumentor/reflection-docblock' => '5.2.2@069a785b2141f5bcf49f3e353548dc1cce6df556',
  'phpdocumentor/type-resolver' => '1.4.0@6a467b8989322d92aa1c8bf2bebcc6e5c2ba55c0',
  'phpmailer/phpmailer' => 'v6.5.0@a5b5c43e50b7fba655f793ad27303cd74c57363c',
  'phpoption/phpoption' => '1.7.5@994ecccd8f3283ecf5ac33254543eb0ac946d525',
  'psr/cache' => '1.0.1@d11b50ad223250cf17b86e38383413f5a6764bf8',
  'psr/container' => '1.1.1@8622567409010282b7aeebe4bb841fe98b58dcaf',
  'psr/event-dispatcher' => '1.0.0@dbefd12671e8a14ec7f180cab83036ed26714bb0',
  'psr/http-factory' => '1.0.1@12ac7fcd07e5b077433f5f2bee95b3a771bf61be',
  'psr/http-message' => '1.0.1@f6561bf28d520154e4b0ec72be95418abe6d9363',
  'psr/http-server-handler' => '1.0.1@aff2f80e33b7f026ec96bb42f63242dc50ffcae7',
  'psr/http-server-middleware' => '1.0.1@2296f45510945530b9dceb8bcedb5cb84d40c5f5',
  'psr/log' => '1.1.4@d49695b909c3b7628b6289db5479a1c204601f11',
  'psr/simple-cache' => '1.0.1@408d5eafb83c57f6365a3ca330ff23aa4a5fa39b',
  'ralouphie/getallheaders' => '3.0.3@120b605dfeb996808c31b6477290a714d356e822',
  'ramsey/collection' => '1.1.4@ab2237657ad99667a5143e32ba2683c8029563d4',
  'ramsey/uuid' => '4.1.1@cd4032040a750077205918c86049aa0f43d22947',
  'respect/stringifier' => '0.2.0@e55af3c8aeaeaa2abb5fa47a58a8e9688cc23b59',
  'respect/validation' => '2.2.3@4c21a7ffc9a4915673cb2c2843963919e664e627',
  'robmorgan/phinx' => '0.12.7@bdd8f337fcdf24c20d0b708664a85ca9b8d5dbe2',
  'slim/psr7' => '1.4@0dca983ca32a26f4a91fb11173b7b9eaee29e9d6',
  'slim/slim' => '4.8.1@c8934c35d9d98b1a1df9f99ee69b77a59e0aa820',
  'swiftmailer/swiftmailer' => 'v6.2.7@15f7faf8508e04471f666633addacf54c0ab5933',
  'symfony/cache' => 'v5.3.4@944db6004fc374fbe032d18e07cce51cc4e1e661',
  'symfony/config' => 'v5.3.4@4268f3059c904c61636275182707f81645517a37',
  'symfony/console' => 'v5.3.6@51b71afd6d2dc8f5063199357b9880cea8d8bfe2',
  'symfony/contracts' => 'v2.4.0@8434102b404d119dcaf98c8fe19a2655573ac17a',
  'symfony/dependency-injection' => 'v5.3.4@5a825e4b386066167a8b55487091cb62beec74c2',
  'symfony/dom-crawler' => 'v5.2.12@c983279c00f723eef8da2a4b1522296c82dc75da',
  'symfony/dotenv' => 'v5.3.6@b6d44663cff8c9880ee64d232870293a11e14cd6',
  'symfony/error-handler' => 'v5.3.4@281f6c4660bcf5844bb0346fe3a4664722fe4c73',
  'symfony/event-dispatcher' => 'v5.3.4@f2fd2208157553874560f3645d4594303058c4bd',
  'symfony/expression-language' => 'v5.3.4@d4367d36217dd395b10f61649a6bf2c1367140d8',
  'symfony/filesystem' => 'v5.3.4@343f4fe324383ca46792cae728a3b6e2f708fb32',
  'symfony/finder' => 'v5.3.4@17f50e06018baec41551a71a15731287dbaab186',
  'symfony/flex' => 'v1.13.3@2597d0dda8042c43eed44a9cd07236b897e427d7',
  'symfony/framework-bundle' => 'v5.3.4@2c5ed14a5992a2d04dfdb238a5f9589bab0a68d8',
  'symfony/http-foundation' => 'v5.3.6@a8388f7b7054a7401997008ce9cd8c6b0ab7ac75',
  'symfony/http-kernel' => 'v5.3.6@60030f209018356b3b553b9dbd84ad2071c1b7e0',
  'symfony/monolog-bridge' => 'v5.3.4@a0d881165b902a04f41e873426aa52a068064ac4',
  'symfony/monolog-bundle' => 'v3.7.0@4054b2e940a25195ae15f0a49ab0c51718922eb4',
  'symfony/polyfill-ctype' => 'v1.23.0@46cd95797e9df938fdd2b03693b5fca5e64b01ce',
  'symfony/polyfill-intl-grapheme' => 'v1.23.1@16880ba9c5ebe3642d1995ab866db29270b36535',
  'symfony/polyfill-intl-idn' => 'v1.23.0@65bd267525e82759e7d8c4e8ceea44f398838e65',
  'symfony/polyfill-intl-normalizer' => 'v1.23.0@8590a5f561694770bdcd3f9b5c69dde6945028e8',
  'symfony/polyfill-mbstring' => 'v1.23.1@9174a3d80210dca8daa7f31fec659150bbeabfc6',
  'symfony/polyfill-php73' => 'v1.23.0@fba8933c384d6476ab14fb7b8526e5287ca7e010',
  'symfony/polyfill-php80' => 'v1.23.1@1100343ed1a92e3a38f9ae122fc0eb21602547be',
  'symfony/polyfill-php81' => 'v1.23.0@e66119f3de95efc359483f810c4c3e6436279436',
  'symfony/process' => 'v5.3.4@d16634ee55b895bd85ec714dadc58e4428ecf030',
  'symfony/routing' => 'v5.3.4@0a35d2f57d73c46ab6d042ced783b81d09a624c4',
  'symfony/stopwatch' => 'v5.3.4@b24c6a92c6db316fee69e38c80591e080e41536c',
  'symfony/string' => 'v5.3.3@bd53358e3eccec6a670b5f33ab680d8dbe1d4ae1',
  'symfony/var-dumper' => 'v5.3.6@3dd8ddd1e260e58ecc61bb78da3b6584b3bfcba0',
  'symfony/var-exporter' => 'v5.3.4@b7898a65fc91e7c41de7a88c7db9aee9c0d432f0',
  'symfony/yaml' => 'v5.3.6@4500fe63dc9c6ffc32d3b1cb0448c329f9c814b7',
  'twig/twig' => 'v2.14.6@27e5cf2b05e3744accf39d4c68a3235d9966d260',
  'vlucas/phpdotenv' => 'v5.3.0@b3eac5c7ac896e52deab4a99068e3f4ab12d9e56',
  'webmozart/assert' => '1.10.0@6964c76c7804814a842473e0c8fd15bab0f18e25',
  'whichbrowser/parser' => 'v2.1.2@bcf642a1891032de16a5ab976fd352753dd7f9a0',
  'doctrine/instantiator' => '1.4.0@d56bf6102915de5702778fe20f2de3b2fe570b5b',
  'myclabs/deep-copy' => '1.10.2@776f831124e9c62e1a2c601ecc52e776d8bb7220',
  'phar-io/manifest' => '1.0.1@2df402786ab5368a0169091f61a7c1e0eb6852d0',
  'phar-io/version' => '1.0.1@a70c0ced4be299a63d32fa96d9281d03e94041df',
  'phpspec/prophecy' => 'v1.10.3@451c3cd1418cf640de218914901e51b064abb093',
  'phpunit/php-code-coverage' => '6.0.5@4cab20a326d14de7575a8e235c70d879b569a57a',
  'phpunit/php-file-iterator' => '1.4.5@730b01bc3e867237eaac355e06a36b85dd93a8b4',
  'phpunit/php-text-template' => '1.2.1@31f8b717e51d9a2afca6c9f046f5d69fc27c8686',
  'phpunit/php-timer' => '2.1.3@2454ae1765516d20c4ffe103d85a58a9a3bd5662',
  'phpunit/phpunit' => '7.0.0@9b3373439fdf2f3e9d1578f5e408a3a0d161c3bc',
  'sebastian/code-unit-reverse-lookup' => '1.0.2@1de8cd5c010cb153fcd68b8d0f64606f523f7619',
  'sebastian/comparator' => '2.1.3@34369daee48eafb2651bea869b4b15d75ccc35f9',
  'sebastian/diff' => '3.0.3@14f72dd46eaf2f2293cbe79c93cc0bc43161a211',
  'sebastian/environment' => '3.1.0@cd0871b3975fb7fc44d11314fd1ee20925fce4f5',
  'sebastian/exporter' => '3.1.3@6b853149eab67d4da22291d36f5b0631c0fd856e',
  'sebastian/global-state' => '2.0.0@e8ba02eed7bbbb9e59e43dedd3dddeff4a56b0c4',
  'sebastian/object-enumerator' => '3.0.4@e67f6d32ebd0c749cf9d1dbd9f226c727043cdf2',
  'sebastian/object-reflector' => '1.1.2@9b8772b9cbd456ab45d4a598d2dd1a1bced6363d',
  'sebastian/recursion-context' => '3.0.1@367dcba38d6e1977be014dc4b22f47a484dac7fb',
  'sebastian/version' => '2.0.1@99732be0ddb3361e16ad77b68ba41efc8e979019',
  'theseer/tokenizer' => '1.2.1@34a41e998c2183e22995f158c581e7b5e755ab9e',
  'sebastian/resource-operations' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'container-interop/container-interop' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-cache' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-config' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-eventmanager' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-filter' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-hydrator' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-json' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-serializer' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-servicemanager' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-stdlib' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-code' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'zendframework/zend-i18n' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'padraic/phar-updater' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'phpunit/php-token-stream' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  'phpunit/phpunit-mock-objects' => '*@01ad1d22d384649fa638d2125f40de10b5d544a5',
  '__root__' => 'dev-master@01ad1d22d384649fa638d2125f40de10b5d544a5',
);

    private function __construct()
    {
    }

    /**
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function rootPackageName() : string
    {
        if (!class_exists(InstalledVersions::class, false) || !(method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return self::ROOT_PACKAGE_NAME;
        }

        return InstalledVersions::getRootPackage()['name'];
    }

    /**
     * @throws OutOfBoundsException If a version cannot be located.
     *
     * @psalm-param key-of<self::VERSIONS> $packageName
     * @psalm-pure
     *
     * @psalm-suppress ImpureMethodCall we know that {@see InstalledVersions} interaction does not
     *                                  cause any side effects here.
     */
    public static function getVersion(string $packageName): string
    {
        if (class_exists(InstalledVersions::class, false) && (method_exists(InstalledVersions::class, 'getAllRawData') ? InstalledVersions::getAllRawData() : InstalledVersions::getRawData())) {
            return InstalledVersions::getPrettyVersion($packageName)
                . '@' . InstalledVersions::getReference($packageName);
        }

        if (isset(self::VERSIONS[$packageName])) {
            return self::VERSIONS[$packageName];
        }

        throw new OutOfBoundsException(
            'Required package "' . $packageName . '" is not installed: check your ./vendor/composer/installed.json and/or ./composer.lock files'
        );
    }
}
