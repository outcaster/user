# This file contains a user story for the phone number of a tenant
# More information about this Use Case:
# https://app.nuclino.com/Esprit/SmartPlatform/Use-Case-One-Phone-Number-of-a-tenant-a1f24c94-6a31-4921-8683-5cd2122df14a

Feature:
  In order to accomplish the fist use case, we have to get the user phone number
  when we ask the platform for an existing tenant

  Scenario: It gets a phone number for an existing user (Api client approach)
    Given the "Content-Type" request header is "application/json"
    And the "Accept" request header is "application/json"
    When I request "/user/v1/getphonenumber/Connor"
    Then the response code is 200
    And the response body is a JSON array with a length of at least 1

  Scenario: It gets a phone number for an existing user (REST Context approach)
    Given I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    When I send a "GET" request to "/user/v1/getphonenumber/Connor"
    Then the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"

  Scenario: It tries to get a phone number without name (Api client)
    Given the "Content-Type" request header is "application/json"
    And the "Accept" request header is "application/json"
    When I request "/user/v1/getphonenumber"
    Then the response code is 404
