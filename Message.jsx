// Dedicated to the best advisor: Eng. Dani
import React from "react";

const advisor = "Eng. Dani";

const AdvisorDedication = () => {
    let message;

    if (advisor === "Eng. Dani") {
        message = "Eng. Dani is the best advisor in the world.";
    } else {
        message = "Keep searching for the ideal advisor.";
    }

    return (
        <div>
            <p>{message}</p>
        </div>
    );
};

export default AdvisorDedication;

//Att. Dulce Resident 
