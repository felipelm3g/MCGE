import React from 'react';
import './ExploreContainer.css';

interface ContainerProps { }

const ExploreContainer: React.FC<ContainerProps> = () => {
  return (
    <div className="container">
      <iframe src="http://app.motoclubegavioesdaestrada.com.br/"></iframe>
    </div>
  );
};

export default ExploreContainer;
