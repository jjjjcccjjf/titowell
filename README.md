# Titowell API
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/sakyamuni.svg)](http://lunagao.github.io/BlessYourCodeTag/)
[![Bless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/fsm.svg)](http://lunagao.github.io/BlessYourCodeTag/)
[![JesusBless](https://cdn.rawgit.com/LunaGao/BlessYourCodeTag/master/tags/jesus.svg)](https://github.com/LunaGao/BlessYourCodeTag)

## Table of contents

1. **Push routes**
    + [Happiness meter](#happiness-meter)
    + [Pedometer counter](#pedometer-counter)
    + [Picture book](#picture-book)
    + [TiTo](#tito)
    + [Welness program](#wellness-program)
1. **Pull routes**
    + [Users](#users)
    + [Activities](#activities)
    + [BMI Info](#bmi-info)
   

### Happiness meter
POST `api/happiness-meter`   

##### Payload

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
| user_id        |  yes     |  int      |        -          |  1
| datetime       |  yes     |  datetime | datetime recorded |  2018-11-30 11:11:11
| mood           |  yes     |  int      | 1, 2, 3           |  1


##### Response
```javascript
200 OK

 
```

### Pedometer counter
POST `api/pedometer-counter`   

##### Payload

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
| user_id        |  yes     |  int      |        -          |  1
| datetime       |  yes     |  datetime | datetime recorded |  2018-11-30 11:11:11
| step_count     |  yes     |  int      |        -          |  300


##### Response
```javascript
200 OK

 
```

### Picture book
POST `api/picture-book`   

##### Payload

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
| user_id        |  yes     |  int      |        -          |  1
| datetime       |  yes     |  datetime | datetime recorded |  2018-11-30 11:11:11
| pic_file       |  yes     |  file     | pag same filename parin yung sinend, iiignore ko na. won't upload again. will just use reference from the previous pic file |  cutepicture.jpg


##### Response
```javascript
200 OK

 
```

### TiTo
POST `api/tito`   

##### Payload

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
| user_id        |  yes     |  int      |        -          |  1
| datetime       |  yes     |  datetime | datetime recorded |  2018-11-30 11:11:11
| weight_in_pounds |  yes     |  int    | -  |  140
| type           |  yes     |  string   | enum('ti', 'to')  |  ti


### Wellness Program
POST `api/wellness-program`   

##### Payload

|      Name      | Required |   Type    |    Description    |    Sample Data 
|----------------|----------|-----------|-------------------|-----------------------
| user_id        |  yes     |  int      |        -          |  1
| activity_id    |  yes     |  int      |        -          |  1
| datetime       |  yes     |  datetime | datetime recorded |  2018-11-30 11:11:11
| mood           |  yes     |  int    | 1, 2, 3, 4, 5       |  5
| comment        |  no      |  string   | -                 |  I love today's session!


##### Response
```javascript
200 OK

 
```

### Users
GET `api/users/timestamp/:unix_timestamp`   

##### Response
```javascript
200 OK
{
  "data": [
    {
      "id": "3",
      "fname": "Delta",
      "lname": "One",
      "pin": "12345",
      "gender": "male",
      "birth_date": "1994-12-24",
      "profile_pic_file": "https:\/\/robohash.org\/delta.png?set=set4&size=150x150",
      "height_in_feet": "5",
      "height_in_inches": "8",
      "created_at": "2019-12-11 14:30:31",
      "updated_at": "2019-12-11 14:31:31"
    },
    {
      "id": "1",
      "fname": "Endan",
      "lname": "Pendleton",
      "pin": "12345",
      "gender": "male",
      "birth_date": "1994-12-10",
      "profile_pic_file": "https:\/\/robohash.org\/endan.png?set=set4&size=150x150",
      "height_in_feet": "5",
      "height_in_inches": "7",
      "created_at": "2019-12-09 13:39:51",
      "updated_at": "2019-12-09 18:39:51"
    },
    {
      "id": "2",
      "fname": "Jhondz",
      "lname": "Anib",
      "pin": "12345",
      "gender": "male",
      "birth_date": "1994-12-24",
      "profile_pic_file": "https:\/\/robohash.org\/jhondz.png?set=set4&size=150x150",
      "height_in_feet": "5",
      "height_in_inches": "7",
      "created_at": "2019-12-09 20:39:51",
      "updated_at": "0000-00-00 00:00:00"
    }
  ],
  "meta": {
    "message": "Got all data",
    "code": "ok",
    "status": 200,
    "last_update_ymd": "2019-12-11 14:31:31",
    "last_update_unix": 1576071091
  }
}
```

##### Response
```javascript
200 OK
{
  "data": {},
  "meta": {
    "message": "No new data",
    "code": "you_are_up_to_date",
    "status": 200,
    "last_update_ymd": "2019-12-11 14:31:31",
    "last_update_unix": 1576071091
  }
} 
```



### BMI Info
GET `api/bmi-info/timestamp/:unix_timestamp`   

##### Response
```javascript
200 OK
{
  "data": [
    {
      "id": "1",
      "label": "Underweight",
      "description": "There are many reasons why people become underweight. Some do not eat a healthy, balanced diet. This may be for a variety of reasons including feeling too busy to eat, forgetting to eat, or even not being able to afford to eat sufficient nutritious foods. Even in a wealthy country like Australia some groups may find it difficult to provide enough food from the five food groups to eat every day. Weight loss can also be due to physical illness, such as infections, cancer or other conditions. Some people experience weight loss at times of stress.",
      "notes_health_risks": "Being underweight has important implications for your health. People who are very underweight:\r\n- Are at higher risk of having osteoporosis, decreased muscle strength, hypothermia and lowered immunity\r\n- May not live as long as those who are a healthy weight.\r\n",
      "min_bmi": "0",
      "max_bmi": "18.49",
      "created_at": "2019-12-09 14:03:06",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "label": "Healthy weight range",
      "description": "There are many reasons why being a healthy weight is important.\r\n\r\nDid you know that a person with a BMI of between 30 and 35 may die two to four years earlier than someone of a healthy weight?\r\n\r\nAnd a person with a BMI of between 40 and 45 may die eight to 10 years earlier.\r\n\r\nPeople who are very underweight may also not live as long as those who are a healthy weight.",
      "notes_health_risks": "But it’s not just about the risk of dying younger, it’s also about your quality of life – or how well you feel. People who are a healthy weight have a lower risk of:\r\n\r\n-Heart disease\r\n-Stroke\r\n-High blood pressure\r\n-Type 2 diabetes\r\n-Some types of cancer\r\n-Kidney disease\r\n-Back pain\r\n-Knee pain\r\n-Infertility\r\n-Breathing problems\r\n-Anxiety\r\n-Depression\r\n-Sleep problems\r\n-Gall bladder disease\r\n-Fatty liver disease",
      "min_bmi": "18.5",
      "max_bmi": "24.9",
      "created_at": "2019-12-09 14:03:06",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "3",
      "label": "Overweight",
      "description": "If your BMI is between 25 and 29.9, your BMI is within the overweight category. This may not be good for your health",
      "notes_health_risks": "Test",
      "min_bmi": "25",
      "max_bmi": "29.9",
      "created_at": "2019-12-09 14:03:06",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "4",
      "label": "Obese",
      "description": "If you BMI is 30 or over, you are within the obese category. This may not be good for your health. There are many benefits of moving towards a healthy weight and losing even a small amount of weight can bring health benefits",
      "notes_health_risks": "Test",
      "min_bmi": "30",
      "max_bmi": "999",
      "created_at": "2019-12-09 14:03:06",
      "updated_at": "0000-00-00 00:00:00"
    }
  ],
  "meta": {
    "message": "Got all data",
    "code": "ok",
    "status": 200,
    "last_update_ymd": "2019-12-09 14:03:06",
    "last_update_unix": 1575896586
  }
} 
```

```javascript
200 OK
{
  "data": {},
  "meta": {
    "message": "No new data",
    "code": "you_are_up_to_date",
    "status": 200,
    "last_update_ymd": "2019-12-09 14:03:06",
    "last_update_unix": 1575896586
  }
} 
```

### Activities
GET `api/activities/timestamp/:unix_timestamp`   

##### Response
```javascript
200 OK
{
  "data": [
    {
      "id": "1",
      "name": "Yoga",
      "pin": "1234",
      "pic_file": "https:\/\/robohash.org\/yoga.png?set=set4&size=150x150",
      "day_scheduled": "wednesday",
      "created_at": "2019-12-09 14:34:42",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "2",
      "name": "Zumba",
      "pin": "1234",
      "pic_file": "https:\/\/robohash.org\/zumba.png?set=set4&size=150x150",
      "day_scheduled": "thursday",
      "created_at": "2019-12-09 14:34:42",
      "updated_at": "0000-00-00 00:00:00"
    },
    {
      "id": "3",
      "name": "Mental health",
      "pin": "1234",
      "pic_file": "https:\/\/robohash.org\/mental.png?set=set4&size=150x150",
      "day_scheduled": "friday",
      "created_at": "2019-12-09 14:34:42",
      "updated_at": "0000-00-00 00:00:00"
    }
  ],
  "meta": {
    "message": "Got all data",
    "code": "ok",
    "status": 200,
    "last_update_ymd": "2019-12-09 14:34:42",
    "last_update_unix": 1575898482
  }
}
```

```javascript
200 OK
{
  "data": {},
  "meta": {
    "message": "No new data",
    "code": "you_are_up_to_date",
    "status": 200,
    "last_update_ymd": "2019-12-09 14:03:06",
    "last_update_unix": 1575896586
  }
} 
```


