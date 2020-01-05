DDD - Chat in Symfony 5
==============

> DDD, CQRS and Event Sourcing implementation with messenger and RabbitMQ
>
> Frontend using VueJS

Following Domain Driver Design 

### What we do in the repo

   - **UUID as binary**.
   - **Command Bus** implementation with messenger
   - Code structured in layers as Domain Driver Design
   - DomainEvents
   - Events to RabbitMQ
   - Logs stored in ElasticSearch and Kibana for reading in `:5601`
   - **Dev environment in Docker**. Orchestrating with **Docker Compose**.
   - Register user flow
   - Security user flow
   - JWT provider
   - Chat feature with mercure and RabbitMQ

### The folder structure 

    src
      \
       |\ App             `Contains the Use Cases of the domain system and the Data Transfer Objects`
       |
       |\ Domain          `The system business logic layer`
       |
       |\ Infra           `Its the implementation of the system outside the model. I.E: Persistence, serialization, etc`
       |
        \ UI              `User Interface. I.E: Controllers, views, etc`


### Setup

The environment is build in PHP7.4 and the containers are on `etc/infrastructure/dev/docker-compose.yml`

start environment with: `docker-compose -f etc/infrastructure/dev/docker-compose.yml up -d`
