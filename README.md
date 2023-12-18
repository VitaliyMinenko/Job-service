# Jobs Rest service.
#### Version 1.0b
#### Author: Vitalii Minenko

Rest service for CRD for the jobs using Redis as data-holder.

##### Requirements
* Docker
* WSL 2.0
* PowerShell
* IDE
* Postman

##### How to start
* To start the application, you should install Docker and set up WSL engine.
* Clone the application into the folder with Docker.
* Copy .env.example to .env in the main folder.
* Open your project with a command-line shell application, for example, PowerShell, and execute the following command:
```
make up
```
That command start docker and strat job process at laravel
By default, your application will use http://localhost or http://0.0.0.0

* Now, the application is ready, and you can use and test it by Rest API endpoints, for example, by Postman. Please enjoy ;)

##### Endpoints for Create Read and Delete jobs.
For creating new Job please use next endpoint and payload at json using method POST:
```
http://localhost/api/v1/jobs

POST /api/v1/jobs/658029ef8a8c5 HTTP/1.1
Accept: application/json
Content-Type: application/json
{
  "urls": [
    "https://my-site.local",
    "https://jobs.loc",
    "https://exam.com"
  ],
  "selectors": [
    "div.content > p",
    ".side-bar",
    ".top-bar > .element"
    ]
}
```
For getting information about stored job please use next endpoint using method GET.
```
http://localhost/api/v1/jobs/658029ef8a8c5

GET /api/v1/jobs/{ID} HTTP/1.1
Host: localhost

```
For deleting job please use next endpoint using method DELETE.
```
http://localhost/api/v1/jobs/658029ef8a8c5

DELETE /api/v1/jobs/{ID} HTTP/1.1
Host: localhost
```