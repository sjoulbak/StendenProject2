<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post">
  <md-input-container style = "width:225px;">
      <label type="text" for="name">Naam</label>
      <input id="#name" class="form-styling" type="text" name="name" ng-model="name" required/>
  </md-input-container>
  <md-input-container style = "width:225px;">
      <label type="text" for="lastname">Achternaam</label>
      <input id="#lastname" class="form-styling" type="text" name="lastname" ng-model="lastname" required/>
  </md-input-container>
  <md-input-container style = "width:225px;">
      <label type="text" for="username">Gebruikersnaam</label>
      <input id="#username" class="form-styling" type="text" name="username" ng-model="username" required/>
  </md-input-container>
  <md-input-container style = "width:225px;">
      <label type="password" for="password">Wachtwoord</label>
      <input id="#password" class="form-styling" type="password" name="password" ng-model="password" required/>
  </md-input-container>
  <md-input-container style = "width:225px;">
      <label type="confirmpassword" for="confirmpassword">Nogmaals Wachtwoord</label>
      <input id="#confirmpassword" class="form-styling" type="password" name="confirmpassword" ng-model="confirmpassword" required/>
  </md-input-container>
  <md-input-container>
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Opslaan" name="submit">
  </md-input-container>
</form>

</body>
</html>
