if ! [ -L vendor/laravel/homestead ]
then
    git clone https://github.com/laravel/homestead.git vendor/laravel/homestead
fi

cp -i provision/vagrant/Homestead.example.yaml Homestead.yaml

vagrant up

vagrant ssh