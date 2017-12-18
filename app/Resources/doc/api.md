# Gnomes #

## /api/v1/gnomes ##

### `GET` /api/v1/gnomes ###

_list action_

#### Response ####

id:

  * type: integer
  * description: Gnome's id

name:

  * type: string
  * description: Gnome's name


### `POST` /api/v1/gnomes ###

_create action_

#### Parameters ####

name:

  * type: string
  * required: true
  * description: Gnome's name

strength:

  * type: integer
  * required: true
  * description: Gnome's strength

age:

  * type: integer
  * required: true
  * description: Gnome's age

avatar:

  * type: string
  * required: false
  * description: PNG image encoded with base64

#### Response ####

id:

  * type: integer
  * description: Gnome's id

name:

  * type: string
  * description: Gnome's name

strength:

  * type: integer
  * description: Gnome's strength

age:

  * type: integer
  * description: Gnome's age

avatar:

  * type: object (Image)
  * description: Gnome's avatar (image URL)


## /api/v1/gnomes/{id} ##

### `DELETE` /api/v1/gnomes/{id} ###

_delete action_

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: Gnome's id


### `GET` /api/v1/gnomes/{id} ###

_read action_

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: Gnome's id

#### Response ####

id:

  * type: integer
  * description: Gnome's id

name:

  * type: string
  * description: Gnome's name

strength:

  * type: integer
  * description: Gnome's strength

age:

  * type: integer
  * description: Gnome's age

avatar:

  * type: object (Image)
  * description: Gnome's avatar (image URL)


### `PUT` /api/v1/gnomes/{id} ###

_update action_

#### Requirements ####

**id**

  - Requirement: \d+
  - Type: integer
  - Description: Gnome's id

#### Parameters ####

name:

  * type: string
  * required: true
  * description: Gnome's name

strength:

  * type: integer
  * required: true
  * description: Gnome's strength

age:

  * type: integer
  * required: true
  * description: Gnome's age

avatar:

  * type: string
  * required: false
  * description: PNG image encoded with base64

#### Response ####

id:

  * type: integer
  * description: Gnome's id

name:

  * type: string
  * description: Gnome's name

strength:

  * type: integer
  * description: Gnome's strength

age:

  * type: integer
  * description: Gnome's age

avatar:

  * type: object (Image)
  * description: Gnome's avatar (image URL)
