const BASE_URL = "http://localhost/VueJS/visiteurs_app/backend";

// Ajouter un visiteur
export async function ajouterVisiteur(visiteur) {
  try {
    const response = await fetch(`${BASE_URL}/add.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(visiteur)
    });
    return await response.json();
  } catch (error) {
    return { success: false, message: "Erreur lors de l'ajout" };
  }
}

// Lister les visiteurs
export async function listerVisiteurs() {
  try {
    const response = await fetch(`${BASE_URL}/list.php`);
    return await response.json();
  } catch (error) {
    return [];
  }
}

// Supprimer un visiteur
export async function supprimerVisiteur(id) {
  try {
    const response = await fetch(`${BASE_URL}/delete.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({ id })
    });
    return await response.json();
  } catch (error) {
    return { success: false, message: "Erreur lors de la suppression" };
  }
}

// Modifier un visiteur
export async function modifierVisiteur(visiteur) {
  try {
    const response = await fetch(`${BASE_URL}/update.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify(visiteur)
    });
    return await response.json();
  } catch (error) {
    return { success: false, message: "Erreur lors de la modification" };
  }
}

// Récupérer les données de bilan
export async function getBilan() {
  try {
    const response = await fetch(`${BASE_URL}/bilan.php`);
    return await response.json();
  } catch (error) {
    return { total: 0, min: 0, max: 0 };
  }
}
