<?php
\think\Console::starting(function (\think\Console $console) {
    $console->addCommands([
        'curd:make' => '\\jszsl001\\tp6curd\\command\\Curd',
        'curd:init' => '\\jszsl001\\tp6curd\\command\\Init'
    ]);
});
