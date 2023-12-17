## News Aggregator

A sophisticated News Aggregator built on Laravel, offering a seamless blend of real-time news updates and user-friendly interactions. This project employs a strategic design pattern, empowering users with the ability to effortlessly integrate diverse news providers. With a hybrid storage approach utilizing Elasticsearch and MariaDB, it ensures optimal performance and data organization. The scheduled scraper command runs daily, extracting articles from various providers, while users can manually trigger the process. Dive into the Postman collection for easy API testing. Explore and stay informed with the News Aggregator.

### Selected Providers::
* [NewsApiOrg](https://newsapi.org/)
* [New York Times](https://developer.nytimes.com/apis)
* [The Guardian](https://open-platform.theguardian.com/documentation/)

## Technologies Used

The project is developed using the following technologies:

- **PHP:** Version 8.2
- **Laravel:** Version 10.33.0
- **MariaDB:** Version 10
- **Elasticsearch:** Version 7.10.0
- **Kibana:** Version 7.10.0
- **Docker:** Used for containerization

## Installation & Preparing the environment
Follow these steps in the specified order:

- Install the dependencies
``` 
composer update
```
Start the Docker containers
``` 
docker-compose up -d
```
Run migrations and seed the database
``` 
docker exec -ti news-aggregator-laravel.test-1  php artisan migrate:fresh --seed
``` 

## Now the project is working correctly,
The scheduled scraping command is configured to run daily at 05:00 AM. It extracts data from various news providers and sources, scraping articles from the previous day each day.

To run the command manually:
```
php artisan news:scraper
```

* Additionally, I have included the Postman API collection along with the project. Each API within the collection comes with examples, allowing for easy testing and exploration. Feel free to test the APIs directly using the provided Postman collection.

* Registration is a straightforward process—simply sign up to create an account. After registration, you can log in and utilize the acquired token to interact with various APIs. This token serves as your authentication key for accessing different features and functionalities.

# System Design

### Methodology

A concise overview of the methodology adopted in developing the application:

* Utilizing the strategy design pattern, three distinct news providers have been successfully implemented. This approach provides flexibility to extend the system and incorporate additional providers easily.
### Main Business Logic
The main business logic is located in the following namespace:

```
App\Modules\NewsProviders
```

* For storage, a hybrid approach using both relational and non-relational databases has been adopted. Scraped data is stored in Elasticsearch, offering flexibility for filtering and quick storage or retrieval. Other data, such as authentication details, user preferences, and related information, is managed in MariaDB. This combination ensures optimal performance and data organization.

### Main Scraper Class
The main scraper class, triggering all processes, is located in the following namespace:

```
App\Modules\NewsScraper
```

### Main Elasticsearch Service

The primary Elasticsearch service is located in the following namespace:

```
App\Services\Elasticsearch
```
