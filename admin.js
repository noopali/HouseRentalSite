document.addEventListener('DOMContentLoaded', function() {
    const landlordContainer = document.getElementById('landlordContainer');
    const tenantContainer = document.getElementById('tenantContainer');
  
    // Sample landlord and tenant data
    const landlords = [
      { id: 1, name: 'John Doe', email: 'john@example.com', properties: 3 },
      { id: 2, name: 'Jane Smith', email: 'jane@example.com', properties: 2 },
      { id: 3, name: 'Mike Johnson', email: 'mike@example.com', properties: 1 }
    ];
  
    const tenants = [
      { id: 1, name: 'Sarah Anderson', email: 'sarah@example.com', rents: 2 },
      { id: 2, name: 'Tom Wilson', email: 'tom@example.com', rents: 1 },
      { id: 3, name: 'Emily Davis', email: 'emily@example.com', rents: 3 }
    ];
  
    // Display landlords
    if (landlords.length === 0) {
      const noLandlordsElement = document.createElement('p');
      noLandlordsElement.classList.add('no-landlords');
      noLandlordsElement.textContent = 'No landlords found.';
      landlordContainer.appendChild(noLandlordsElement);
    } else {
      landlords.forEach(landlord => {
        const landlordCard = createCard(landlord, 'landlord-card');
  
        const propertyCount = document.createElement('p');
        propertyCount.classList.add('property-count');
        propertyCount.textContent = `Number of properties: ${landlord.properties}`;
        landlordCard.appendChild(propertyCount);
  
        const deleteBtn = document.createElement('button');
        deleteBtn.classList.add('delete-btn');
        deleteBtn.textContent = 'Delete';
        deleteBtn.addEventListener('click', function() {
          // Handle delete functionality for landlords here
          deleteLandlord(landlord.id);
        });
        landlordCard.appendChild(deleteBtn);
  
        landlordContainer.appendChild(landlordCard);
      });
    }
  
    // Display tenants
    if (tenants.length === 0) {
      const noTenantsElement = document.createElement('p');
      noTenantsElement.classList.add('no-tenants');
      noTenantsElement.textContent = 'No tenants found.';
      tenantContainer.appendChild(noTenantsElement);
    } else {
      tenants.forEach(tenant => {
        const tenantCard = createCard(tenant, 'tenant-card');
  
        const rentCount = document.createElement('p');
        rentCount.classList.add('rent-count');
        rentCount.textContent = `Number of rents: ${tenant.rents}`;
        tenantCard.appendChild(rentCount);
  
        const deleteBtn = document.createElement('button');
        deleteBtn.classList.add('delete-btn');
        deleteBtn.textContent = 'Delete';
        deleteBtn.addEventListener('click', function() {
          // Handle delete functionality for tenants here
          deleteTenant(tenant.id);
        });
        tenantCard.appendChild(deleteBtn);
  
        tenantContainer.appendChild(tenantCard);
      });
    }
  
    function createCard(data, cardClass) {
      const card = document.createElement('div');
      card.classList.add(cardClass);
  
      const heading = document.createElement('h3');
      heading.textContent = data.name;
      card.appendChild(heading);
  
      const email = document.createElement('p');
      email.textContent = `Email: ${data.email}`;
      card.appendChild(email);
  
      return card;
    }
  
    function deleteLandlord(id) {
      // Implement delete functionality for landlords
    }
  
    function deleteTenant(id) {
      // Implement delete functionality for tenants
    }
  });
  