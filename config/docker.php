<?php

return [
    "endpoint" => "http://localhost",
    "minecraftJava" => [
        "Hostname" => "mincraft-server", 
        "User" => "root",
        "Image" => "minecraftjava:latest",
        "AttachStdout" => false,
        "AttachStderr" => false,
        "OpenStdin" => true,
        "Tty" => true,
        "ExposedPorts" => [],
        "HostConfig" => [
            "PortBindings" => [],
        ]
    ],
    "minecraftBedrock" => [
        "Hostname" => "mincraft-server", 
        "User" => "root",
        "Image" => "minecraftbedrock:latest",
        "OpenStdin" => true,
        "AttachStdout" => false,
        "AttachStderr" => false,
        "Tty" => true,
        "ExposedPorts" => [],
        "HostConfig" => [
            "PortBindings" => [],
        ]
    ],
    "arkserver" => [
        "Hostname" => "ark-server", 
        "User" => "root",
        "Image" => "arkserver:latest",
        "OpenStdin" => true,
        "AttachStdout" => false,
        "AttachStderr" => false,
        "Tty" => true,
        "ExposedPorts" => [],
        "HostConfig" => [
            "PortBindings" => [],
        ]
    ]

];