<?php
    interface iUsb {
        public function start();
        public function stop();
    }

    //相机类实现接口
    class Camera implements iUsb{
        public function start()
        {
            echo "camera start work";
        }

        public function stop(){
            echo "camera stop work";
        }
    }

    class Phone implements iUsb {
        public function start()
        {
            echo "phone start work";
        }

        public function stop(){
            echo "phone stop work";
        }
    }

    $camera1 = new Camera();
    $camera1->start();
    $camera1->stop();