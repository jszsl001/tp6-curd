<?php
\think\Console::starting(function (\think\Console $console) {
    $console->addCommands([
        'curd' => '\\jszsl001\\tp6curd\\command\\Curd'
    ]);
});
