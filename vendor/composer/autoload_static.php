<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd961a5c263c191e636c115e73a3e81fd
{
    public static $prefixLengthsPsr4 = array (
        's' => 
        array (
            'srag\\Plugins\\UserTakeOver\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'srag\\Plugins\\UserTakeOver\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'ilUserTakeOverAbstractGUI' => __DIR__ . '/../..' . '/classes/Util/class.ilUserTakeOverAbstractGUI.php',
        'ilUserTakeOverAccessHandler' => __DIR__ . '/../..' . '/classes/Util/class.ilUserTakeOverAccessHandler.php',
        'ilUserTakeOverConfigGUI' => __DIR__ . '/../..' . '/classes/class.ilUserTakeOverConfigGUI.php',
        'ilUserTakeOverDisplayName' => __DIR__ . '/../..' . '/classes/Helper/trait.ilUserTakeOverDisplayName.php',
        'ilUserTakeOverGeneralRepository' => __DIR__ . '/../..' . '/classes/class.ilUserTakeOverGeneralRepository.php',
        'ilUserTakeOverGroupGUI' => __DIR__ . '/../..' . '/classes/Group/class.ilUserTakeOverGroupGUI.php',
        'ilUserTakeOverGroupRepository' => __DIR__ . '/../..' . '/classes/Group/class.ilUserTakeOverGroupRepository.php',
        'ilUserTakeOverGroupRequestHelper' => __DIR__ . '/../..' . '/classes/Group/trait.ilUserTakeOverGroupRequestHelper.php',
        'ilUserTakeOverImpersonationHandler' => __DIR__ . '/../..' . '/classes/Impersonation/class.ilUserTakeOverImpersonationHandler.php',
        'ilUserTakeOverImpersonationTarget' => __DIR__ . '/../..' . '/classes/Helper/trait.ilUserTakeOverImpersonationTarget.php',
        'ilUserTakeOverMetaBarProvider' => __DIR__ . '/../..' . '/classes/Provider/class.ilUserTakeOverMetaBarProvider.php',
        'ilUserTakeOverOnScreenMessages' => __DIR__ . '/../..' . '/classes/Helper/trait.ilUserTakeOverOnScreenMessages.php',
        'ilUserTakeOverPlugin' => __DIR__ . '/../..' . '/classes/class.ilUserTakeOverPlugin.php',
        'ilUserTakeOverPluginInstance' => __DIR__ . '/../..' . '/classes/Helper/trait.ilUserTakeOverPluginInstance.php',
        'ilUserTakeOverSessionWrapper' => __DIR__ . '/../..' . '/classes/Impersonation/class.ilUserTakeOverSessionWrapper.php',
        'ilUserTakeOverSettingsGUI' => __DIR__ . '/../..' . '/classes/Settings/class.ilUserTakeOverSettingsGUI.php',
        'ilUserTakeOverSettingsRepository' => __DIR__ . '/../..' . '/classes/Settings/class.ilUserTakeOverSettingsRepository.php',
        'ilUserTakeOverTabManager' => __DIR__ . '/../..' . '/classes/Util/class.ilUserTakeOverTabManager.php',
        'ilUserTakeOverTemplateHelper' => __DIR__ . '/../..' . '/classes/Helper/trait.ilUserTakeOverTemplateHelper.php',
        'ilUserTakeOverUIHookGUI' => __DIR__ . '/../..' . '/classes/class.ilUserTakeOverUIHookGUI.php',
        'srag\\Plugins\\UserTakeOver\\ArrayFieldHelper' => __DIR__ . '/../..' . '/src/ArrayFieldHelper.php',
        'srag\\Plugins\\UserTakeOver\\Group\\Group' => __DIR__ . '/../..' . '/src/Group/Group.php',
        'srag\\Plugins\\UserTakeOver\\Group\\IGroupRepository' => __DIR__ . '/../..' . '/src/Group/IGroupRepository.php',
        'srag\\Plugins\\UserTakeOver\\IGeneralRepository' => __DIR__ . '/../..' . '/src/IGeneralRepository.php',
        'srag\\Plugins\\UserTakeOver\\IRequestParameters' => __DIR__ . '/../..' . '/src/IRequestParameters.php',
        'srag\\Plugins\\UserTakeOver\\ITranslator' => __DIR__ . '/../..' . '/src/ITranslator.php',
        'srag\\Plugins\\UserTakeOver\\RequestHelper' => __DIR__ . '/../..' . '/src/RequestHelper.php',
        'srag\\Plugins\\UserTakeOver\\Settings\\ISettingsRepository' => __DIR__ . '/../..' . '/src/Settings/ISettingsRepository.php',
        'srag\\Plugins\\UserTakeOver\\Settings\\Settings' => __DIR__ . '/../..' . '/src/Settings/Settings.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\AbstractFormBuilder' => __DIR__ . '/../..' . '/src/UI/Form/AbstractFormBuilder.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\AbstractFormProcessor' => __DIR__ . '/../..' . '/src/UI/Form/AbstractFormProcessor.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\Group\\GroupFormBuilder' => __DIR__ . '/../..' . '/src/UI/Form/Group/GroupFormBuilder.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\Group\\GroupFormProcessor' => __DIR__ . '/../..' . '/src/UI/Form/Group/GroupFormProcessor.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\IFormBuilder' => __DIR__ . '/../..' . '/src/UI/Form/IFormBuilder.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\IFormProcessor' => __DIR__ . '/../..' . '/src/UI/Form/IFormProcessor.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\Settings\\SettingsFormBuilder' => __DIR__ . '/../..' . '/src/UI/Form/Settings/SettingsFormBuilder.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\Settings\\SettingsFormProcessor' => __DIR__ . '/../..' . '/src/UI/Form/Settings/SettingsFormProcessor.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Form\\TagInputAutoCompleteBinder' => __DIR__ . '/../..' . '/src/UI/Form/TagInputAutoCompleteBinder.php',
        'srag\\Plugins\\UserTakeOver\\UI\\MetaBar\\SearchItem' => __DIR__ . '/../..' . '/src/UI/MetaBar/SearchItem.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Table\\Group\\GroupPresentationTableBuilder' => __DIR__ . '/../..' . '/src/UI/Table/Group/GroupPresentationTableBuilder.php',
        'srag\\Plugins\\UserTakeOver\\UI\\Table\\IPresentationTableBuilder' => __DIR__ . '/../..' . '/src/UI/Table/IPresentationTableBuilder.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd961a5c263c191e636c115e73a3e81fd::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd961a5c263c191e636c115e73a3e81fd::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd961a5c263c191e636c115e73a3e81fd::$classMap;

        }, null, ClassLoader::class);
    }
}
