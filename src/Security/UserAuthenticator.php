<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class UserAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'app_login';

    private UrlGeneratorInterface $urlGenerator;
    private UserPasswordEncoderInterface $passwordEncoder;
    private CsrfTokenManagerInterface $csrfTokenManager;
    private EntityManagerInterface $entityManager;
    private Filesystem $filesystem;
    private $kernel;


    public function __construct(KernelInterface $kernel,Filesystem $filesystem,EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, UserPasswordEncoderInterface $passwordEncoder, CsrfTokenManagerInterface $csrfTokenManager)
    {

        $this->urlGenerator = $urlGenerator;
        $this->passwordEncoder = $passwordEncoder;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->entityManager = $entityManager;
        $this->filesystem = $filesystem;
        $this->kernel = $kernel;
    }


    public function supports(Request $request)
    {

        if($request->attributes->get('_route') === 'app_login' && $request->isMethod('post')){
            return true;
        }
        return false;
    }

    public function getCredentials(Request $request)
    {

        $credentials = [
            'email' => $request->request->get('login')['email'],
            'password' => $request->request->get('login')['password'],
            'csrf_token' => $request->request->get('login')['_token'],
        ];

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $credentials['email']
        );
        return $credentials;

    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $token = new CsrfToken('login_form', $credentials['csrf_token']);

        if (!$this->csrfTokenManager->isTokenValid($token)) {
            throw new InvalidCsrfTokenException();
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $credentials['email']]);

        if (!$user) {
            // fail authentication with a custom error
            throw new CustomUserMessageAuthenticationException('Email could not be found.');
        }
        return $user;
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        if($this->passwordEncoder->isPasswordValid($user, $credentials['password'])){
            return true;
        }
        throw new CustomUserMessageAuthenticationException('Invalid Password');

    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->set(
            Security::AUTHENTICATION_ERROR,
            $exception->getMessage(),
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $providerKey)
    {
        $userDir = $this->kernel->getProjectDir();
        $tmpFolder = $request->request->get('login')['email'];
        $folder = explode('.',$tmpFolder);
        $this->filesystem->mkdir($userDir.'/users/'.$folder[0]);

        $targetPath = $this->urlGenerator->generate('homepage');
        return new RedirectResponse($targetPath);
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $targetPath = $this->urlGenerator->generate('app_login');
        return new RedirectResponse($targetPath);
    }

    public function supportsRememberMe()
    {
        // todo
    }

    protected function getLoginUrl()
    {
        // TODO: Implement getLoginUrl() method.
    }

    public function getPassword($credentials): ?string
    {
        // TODO: Implement getPassword() method.
        return $credentials['password'];
    }
}
