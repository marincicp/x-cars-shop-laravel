<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test("registration screen can be rendered", function () {
   $resposne = $this->get("/signup");

   $resposne->assertStatus(200);
});


test("new users can register", function () {


   $response = $this->post("/signup", [
      "email" => "test@test.com",
      "password" => "password",
      "password_confirmation" => "password",
      "firstName" => "John",
      "lastName" => "Doe",
      "phone" => "0136264677",
   ]);

   $this->assertAuthenticated();
   $response->assertRedirect(route("verification.notice"));
});
