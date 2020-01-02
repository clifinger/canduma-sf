DDD Canduma
==============

> DDD, CQRS and Event Sourcing implementation

In Symfony following DDD (Domain Driver Design). 

### Examples in the repo

   - [x] **UUID as binary** to improve the performance and create a nightmare for the dba.
   - [x] **Command Bus** implementation with messenger
   - [x] Code structured in layers as appears in DDD in php book. 
   - [x] DomainEvents
   - [x] Events to RabbitMQ
   - [ ] Events stored in ElasticSearch and Kibana for reading in `:5601`
   - [x] **Dev environment in Docker**. Boosting build speed with docker **cache layers** in pipeline. Orchestrating with **Docker Compose**.
   - [x] Register user flow
   - [ ] Security user flow
   - [ ] JWT provider
   - [ ] Json Response
   - [ ] Chat feature with mercure and RabbitMQ

### The folder structure 

    src
      \
       |\ App .           `Contains the Use Cases of the domain system and the Data Transfer Objects`
       |
       |\ Domain          `The system business logic layer`
       |
       |\ Infra           `Its the implementation of the system outside the model. I.E: Persistence, serialization, etc`
       |
        \ UI              `User Interface. This use to be inside the Infrastructure layer.`


### The Environment setup

The environment is in PHP7.4 and the development containers are on `etc/infrastructure/dev/docker-compose.yml`

Up environment with: `docker-compose -f etc/infrastructure/dev/docker-compose.yml up -d`


- Rabbit Management: `:15672`
![Rabbit](https://i.imgur.com/Wx881tI.png)

- Kibana: `:5601`
![Kibana](https://i.imgur.com/AKsVA0t.png)
