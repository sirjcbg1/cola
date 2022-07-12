<?php

namespace App\Repository;
use App\Entity\User;
use App\Entity\Cola;
use App\Entity\UserCola;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;




/**
 * @extends ServiceEntityRepository<Cola>
 *
 * @method Cola|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cola|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cola[]    findAll()
 * @method Cola[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ColaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry,EntityManagerInterface $manager)
    {
        parent::__construct($registry, Cola::class);
        $this->manager = $manager;
    }


    public function add(Cola $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }



    public function saveUser($idUser,$idCola)
    {
        $entityManager = $this->getEntityManager();
        $colaUser = new UserCola();
        $entityUser = $entityManager->getRepository(User::class)->findOneById($idUser);          
        $entityCola = $entityManager->getRepository(Cola::class)->findOneById($idCola);          
        $colaUser->setIdUser($entityUser);
        $colaUser->setIdCola($entityCola);
        $this->manager->persist($colaUser);
        $this->manager->flush();
        return $colaUser->getId();
    }


    public function getMejorTiempo()
    {
        $entityManager = $this->getEntityManager();
        $sql = "     
                select b.id,b.descripcion,
                (count(a.id)*tiempo_atencion)as tiempoPorAtender 
                FROM `user_cola` a right join 
               cola b on a.id_cola_id = b.id 
                GROUP by b.id,b.descripcion 
                order by tiempoPorAtender asc limit 0,1;
        ";
 
        $stmt = $entityManager->getConnection()->prepare($sql);
        $result = $stmt->executeQuery()->fetchAllAssociative();
        return $result;
    }


    
    public function getColaById($id)
    {
        $entityManager = $this->getEntityManager();
        $sql = "     
            select a.descripcion,c.nombre,b.fecha_hora 
            from cola a inner join user_cola b on a.id = b.id_cola_id 
            INNER join user c on b.id_user_id = c.id 
            WHERE DATE_ADD(fecha_hora, INTERVAL 2 MINUTE_SECOND) > NOW() and
            a.id=$id  ;
        ";
        $stmt = $entityManager->getConnection()->prepare($sql);
        $result = $stmt->executeQuery()->fetchAllAssociative();
        return $result;
    }

}