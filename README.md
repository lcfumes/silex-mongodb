[![Build Status](https://travis-ci.org/lcfumes/silex-mongodb.svg?branch=master)](https://travis-ci.org/lcfumes/silex-mongodb.svg?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/lcfumes/silex-mongodb/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/lcfumes/silex-mongodb/badges/quality-score.png?b=master)
[![Code Coverage](https://scrutinizer-ci.com/g/lcfumes/silex-mongodb/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/lcfumes/silex-mongodb/badges/coverage.png?b=master)

## Instalation


# Silex with MongoDB 
Silex with MongoDB 

## Docker ##

### dependencies ####

```
sudo apt-get install curl php5-cli php5-curl
```

### Install Docker ###

```
wget -qO- https://get.docker.com/ | sh
```

### Added your user to Docker group ###

```
sudo usermod -aG docker YOUR_USER
```

###  Install Docker-Compose ###

```
curl -L https://github.com/docker/compose/releases/download/1.4.0/docker-compose-`uname -s`-`uname -m` > /usr/local/bin/docker-compose
```

or you can use pip

```
pip install -U docker-compose
```

Apply executable permissions to the binary

```
chmod +x /usr/local/bin/docker-compose
```



## To Run ##
```
/webproject/docker-compose up
```

## To Stop ##

```
/webproject/docker-compose stop
```


## Config ##

add in

```
sudo vim /etc/hosts

127.0.0.1 mongopoc.dev 
127.0.0.1 mongodb.dev
```

## web ##

```
http://mongoproc.dev
```

Contact: Luiz Fumes <lcfumes@gmail.com>
