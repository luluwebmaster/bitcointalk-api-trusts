#### Bitcointalk : API to get trusts of a user.

This little API is a API to get trusts information from the Bitcointalk forum user.

With this API, you can get trusts in JSON format or in a formatted image.

This idea of API comes to me this subject :
- https://bitcointalk.org/index.php?topic=5157603.msg53074017#msg53074017

#### How to install ?

Firstly, clone this project in a folder like this :
- `git clone https://github.com/luluwebmaster/bitcointalk-api-trusts .`

After that, go in `/config` folder and copy `config.example.php` to `config.php`.

Then, create a Bitcointalk user account dedicated to this API ( It is strongly recommended to create a dedicated account ).

When the account is ready, and you are connected on the account, go here and get your captcha code ( Copy code after "ccode=" text ) :
- https://bitcointalk.org/captcha_code.php

Now, go to the `config.php` file, and update `username`, `password`, `captcha-code` with your own values.

While you are in the config, take the opportunity to change the link of the API.

It must correspond to something like this :
- https://api.example.com/trusts/public/api.php

The API is now ready to use !

##### Important for security

If you use Nginx, it is important to point your domain to the "public" folder.

You can also do it for Apache, but it's less important, since the rest of the files are blocked by default.

#### How to use ?

The use of the API is very simple, if you want to recover the JSON format trusts :
- https://api.example.com/trusts/public/api.php?profileId=1305990

And you can see data in image with this link :
- https://api.example.com/trusts/public/image.php?profileId=1305990

Note : API data is cached and refreshed every 2 hours by default ( Configurable in `config.php` file ).

#### Donate

- Bitcoin : 1DSXQn7AankhmXUvExfZBbo8zWa3ie3jXc

#### Contact

- Mail : contact@luc-mergault.fr
- Twitter : [@Luluwebmaster](https://twitter.com/Luluwebmaster)
