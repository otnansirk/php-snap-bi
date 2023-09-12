<?php
namespace Otnansirk\SnapBI\Fixtures;

final class Fixture
{

    /**
     * These values ​​are just examples and are not real.
     *
     * Before run test please
     * Rename this file with Fixture.php
     * Then change with your config value
     *
     * @return array
     */
    public static function configFixture(): array
    {
        return [
            "client_id"       => "a82ed8bf-493a-4133-ba01-08129e3w8432",
            "client_secret"   => "a82ed8bf-493a-4133-ba01-08129e3w8432",
            "ssh_private_key" => <<<SSHKEY
                                -----BEGIN PRIVATE KEY-----
                                MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDDxV9SCePfJzYZ
                                OAO1hy/eipUsxHFIG3ouZQ3fOlHWTGwpLKt25uFEwgrx0TA8MAs4ScBeVd/naNXD
                                +9vWNH8Cssswxn/TUBcs5VWmft0w4Kq8PK/VmxGmToG6yhwjNJLTeXik5SsRQd3d
                                KOuDwvpzjqWRSE8dkbz7ISAaRw5GBKtKhsJFfU+80aJQbYJNU4KH4ez8SrBsrELM
                                FaQ0rRH2oL/WLQBmWPlV2GfOy4KjPFvP09I0b7zim4zTvpYpAl7qKAmTL5mWJkK7
                                ZNrYvQ6zfUG2g2jRzv7q6gIf62/YRN5yCkFBm0TWu0MR0x22AiMt8UxvpDrY3Ibb
                                ArbI62b9AgMBAAECggEARykhQuLRb7YDFhukTYG8Rro9Cy7Etp82RFL7Pd8nDCxv
                                THAuS2QVEdduX0PYsqgMDAPS5vd0EduriDeuayhd2oJeuwZ1DYyZP/qEraaDpFal
                                +RJeH9jkC32R7mG05J8hl7kZv3aFxxoYGWHcaeKfww1g5XRRPcBR3z7lOmgFqjE5
                                gNBgz17sGlglAckCCudcu+RuI4RtvFlpP5pTSDtOPYD09wjelNgc0H7nmzypVfg/
                                NE7Cd6q6rfANUcG2tBRTmIX3RHxgXWksrPV4J+XhMGcDC3r4VHIot7fRKIpf9DZA
                                IomuqYcY3mpcTdQijX4f0V5RksQ4nbjkM277+oiJwQKBgQDko/Fmf6xWAUBo7699
                                IIow96fsB80VxEc9sSBuyT0/m37TLXdW2U98hmN16+QxWJzprUI7TKscMyOYzPIV
                                4bnTa4anLc16qq2dfpNt4fKa7KSaDXOvK7HFIgedergtbQwdVYmV6GDvphwqtW5Z
                                RGyka5ERkQJFCWmd3zwpXNIKtQKBgQDbMoYfygghrJAMi3g8MoKGggzj4D0Gx4Z3
                                ixGMTw9g85xSD9VjxF+XU2zczOnj+P92eHm+5hQrJ+1wxcAuSS9m4iWAoacac5x5
                                EY03mrcu3jTt3zOTvfHBQTOr+QIriz5ht9Uk9oOpZ1mqd21AvX0xvBk6tSHkQFsC
                                0HR6XQbwKQKBgE+WlehlFvtVMjOVA5Rd6FzFSKnLyWMDUP0zlCOcX3qtyQb/s6QC
                                vz2MlkCtHWDkBLL/Aagctw946bI93SMq0QG8U0IMmpNRqF/DeNRuK4IsT9vkRNm8
                                LwR9JlB/nqnKUMZBSURqgJvLSdDAGSpvvBW77+DESWRfewtectW/HsplAoGBAKY9
                                40swderDdhyNilrdU/D/oRcScjY6DNmNN3naXCeDmwMBzy0jOfxi4SV0o86qgdUv
                                +eW2SYWRepsU33Q7PSAiU58C+uEs3XdUwG1zgYqiLDJcHZnnbPrMoIvFBshPirhB
                                2/10mNZZ8789ZDa9f73AksHbriCWTnAL+Mr00tZBAoGAeiXhOYs7+39tPSXK6D70
                                km8/drryNzicud7nm1Rekg6fYzbJ6Ee/p8Y9C7wdwdef/rNMHcAhJEVf3Kyw0gqr
                                PUB9lddfswhEeIGI+cZ1CCvm2y7Yc4665Z8fxFHf2HIaEa0v+rKyhzqS8Xq5ha4m
                                PRzOwU/Wf9yBtYX9NStJheU=
                                -----END PRIVATE KEY-----
                                SSHKEY,
            "ssh_public_key"  => <<<SSHKEY
                                -----BEGIN PUBLIC KEY-----
                                MIIBeZeNBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAw8VfUgnj3yc2GTgDtYcv
                                3oqVeereSBt6LmUN3zpR1kxsKSyrdubhRMIK8dEwPDALOEnAXlXf52jVw/vb1jR/
                                Ao9esrfr01AXLOVVpn7dMOCqvDyv1ZsRpk6BusocIzSS03l4pOUrEUHd3Sjrg8L6
                                c46lkUhPHZG8+yEgGkcORgSrS9bCRX1PvNGiUG2CrrrCh+Hs/EqwbKxCzBWkNK0R
                                9qC/1i0AZlj5VdhnzsuCozxbz9PSNG+84puM076Weeee6igJky+ZliZCu2Ta2L0O
                                s31BtoNo0c7+6ydwd+tv2ETecgpBQZtE1rtDEdMdtgIjLfFMdwd62NyG2wK2yOtm
                                /QIDEQAB
                                -----END PUBLIC KEY-----
                                SSHKEY,
            "partner_id"      => "UAYCORQ011",
            "account_id"      => "0643002227",
            "bank_card_token" => "1234567890",
            "channel_id"      => "92221",
            "base_url"        => "https://api.api.com",
        ];
    }
}