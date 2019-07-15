# This file contains a user story for the phone number of a tenant
# More information about this Use Case:
# https://app.nuclino.com/Esprit/SmartPlatform/Use-Case-One-Phone-Number-of-a-tenant-a1f24c94-6a31-4921-8683-5cd2122df14a

Feature:
  In order to accomplish the fist use case, we have to get the user phone number
  when we ask the platform for an existing tenant

  Scenario: It gets a phone number for an existing user
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/users/v1/phone" with body:
    """
    {
      "name": "Sample tenant"
    }
    """
    Then the response should be in JSON
    And the header "Content-Type" should be equal to "application/json"
    And the JSON nodes should contain:
      | name                   | Sample tenant              |
      | phoneNumber                  | 555555555     |
    And the JSON node "enabled" should be true
