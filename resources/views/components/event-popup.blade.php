  <div id="popupContainer" class="popup-container">
    <div class="popup-content">
      <button onclick="closePopup()" class="popup-close">X</button>

      <h2 id="popupTitle"></h2>

      <div id="tags"></div>

      <div id="struc-partners" class="element">
        <div class="block">
          <div class="svg">{!! $svg['structure'] !!}</div>
          <p id="popupStructure"></p>
        </div>
        <div id="partners" class="block">
          <div class="svg">{!! $svg['partners'] !!}</div>
          <p id="popupPartners"></p>
        </div>
      </div>

      <div id="description" class="block element">
        <div class="svg">{!! $svg['description'] !!}</div>
        <p id="popupDescription"></p>
      </div>

      <div id="people" class="element">
        <div id="number" class="block">
          <div class="svg">{!! $svg['participants'] !!}</div>
          <p id="popupNbreParticipants"></p>
        </div>
        <div id="accessType" class="block">
          <div class="svg">{!! $svg['accessType'] !!}</div>
          <p id="popupAccessType"></p>
        </div>
      </div>

      <div id="dateEvent" class="element">
        <div class="block">
          <div class="svg">{!! $svg['date'] !!}</div>
          <p id="popupDate"></p>
          <p id="popupHours"></p>
        </div>
        <div class="block">
          <div class="svg">{!! $svg['locate'] !!}</div>
          <p id="popupLocation"></p>
        </div>
      </div>

      <div id="author" class="block element">
        <div class="svg">{!! $svg['user'] !!}</div>
        <p id="popupAuthor"></p>
      </div>

    </div>
  </div>